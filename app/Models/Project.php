<?php namespace App\Models;

use Bkwld\Cloner\Cloneable;
use App\Models\AdminUser;
use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use function App\Helpers\has_approved_template_type;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

/**
 * Class Project
 *
 * @package App\Models
 */
class Project extends Model implements HasMediaCollections, HasMediaConversions {
    use HasMediaCollectionsTrait, HasMediaThumbsTrait, LogsActivity, Cloneable, SoftDeletes;

    /**
     * @var array
     */
    protected $cloneable_relations = [
        'lines',
        'sales_persons'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'sales_representative_id',
        'csr',
        'contact_id',
        'title',
        'quantity',
        'trim_size',
        'extent',
        'orientation',
        'fields',
        'finishing_information',
        'packaging_information',
        'origination',
        'information_requests',
        'materials_in_at',
        'fields',
        'fob_at',
        'delivery_at',
        'vendor_notes',
        'vendor_id',
        'vendor_payment_term_id',
        'customer_shipping_to',
        'approved_manager_id',
        'approved_at',
        'base_project_id',
        'status',
        'template_type',
        'additional_comments',
        'payment_term_id',
        'remittance_id',
        'jcp_fields',
        'reference',
        'user_id',

        'sales_invoice_lines',
        'invoice_lines_inc_po',
        'fcq_signed_at',
        'project_stage_checklist',
        'aa_template',
    ];

    /**
     * @var array
     */
    protected static $logAttributes = [
        'client_id',
        'sales_representative_id',
        'csr',
        'contact_id',
        'title',
        'quantity',
        'trim_size',
        'extent',
        'orientation',
        'fields',
        'finishing_information',
        'packaging_information',
        'origination',
        'information_requests',
        'materials_in_at',
        'fields',
        'fob_at',
        'delivery_at',
        'vendor_notes',
        'vendor_id',
        'vendor_payment_term_id',
        'customer_shipping_to',
        'approved_manager_id',
        'approved_at',
        'status',
        'template_type',
        'additional_comments',
        'payment_term_id',
        'remittance_id',
        'jcp_fields',
        'fcq_signed_at',
        'sales_invoice_lines',
        'project_stage_checklist',
        'aa_template',
        'reference',
        'user_id',
    ];

    /**
     * @var array
     */
    protected static $recordEvents = [ 'deleted', 'updated', 'created' ];

    /**
     * @var string
     */
    protected static $logName = 'system';

    /**
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @var array
     */
    protected $dates = [
        'materials_in_at',
        'delivery_at',
        'fob_at',
        'created_at',
        'updated_at',
        'fcq_signed_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'fields' => 'array',
        'jcp_fields' => 'array',
        'invoice_lines_inc_po' => 'array',
        'sales_invoice_lines' => 'array',
        'project_stage_checklist' => 'array',
    ];

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $appends = [ 'resource_url', 'approval_map' ];

    /**
     * @var array
     */
    protected $with = [ 'client', 'sales_persons', 'misc_pos' ];

    /**
     *
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope( 'published', function ( Builder $builder ) {
            $builder->whereNull( 'base_project_id' );
        } );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sales_persons() {
        return $this->belongsToMany( \App\Models\AdminUser::class, 'project_salespersons', 'project_id', 'salesperson_id' );
    }

    /**
     * Relationships
     */

    public function client() {
        return $this->belongsTo( Contact::class, 'client_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requester() {
        return $this->belongsTo( AdminUser::class, 'approval_requested_by' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lines() {
        return $this->hasMany( ProjectInvoiceLine::class, 'project_id' );
    }

    public function purchase_order_lines() {
        return $this->hasManyThrough( PurchaseOrderInvoiceLine::class, PurchaseOrder::class, 'project_id', 'purchase_order_id' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contributors() {
        return $this->activities()->select( ['causer_id'] )->groupBy( 'causer_id' )->whereNotNull( 'causer_id' );
    }

    /**
     * @return mixed
     */
    public function linesGroupedByCategory() {
        return $this->lines->groupBy( function( $item ) {
            return $item->category;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany( Project::class, 'base_project_id', 'id' )->withoutGlobalScope( 'published' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_term() {
        return $this->belongsTo( PaymentTerm::class, 'payment_term_id' );
    }

    public function vendor() {
        return $this->belongsTo( Vendor::class, 'vendor_id' );
    }

    public function misc_pos() {
        return $this->hasMany( PurchaseOrder::class, 'project_id', 'id' );
    }

    /**
     * @return array
     */
    public function toArray() {
        $array = parent::toArray(); // TODO: Change the autogenerated stub

        $array[ 'types' ] = [];
        $array[ 'type' ]  = collect( $this->fields )->keys()->toArray();
        $array[ 'jcp_supporting_files' ]  = collect( $this->media()->orderByDesc( 'created_at' )->get()->filter( function ( Media $media ) {
            return in_array( $media->collection_name, [ 'jcp_supporting_files', 'official_files' ] );
        } ) )->map( function( $item ) {
            $array = $item->toArray();

            $array['url'] = $item->getUrl();

            return $array;
        });

        return $array;
    }

    /* ************************ ACCESSOR ************************* */

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getResourceUrlAttribute() {
        return url( '/admin/projects/' . $this->getKey() );
    }

    /**
     * @return array
     */
    public function getTemplateAccessPermissionsAttribute() {
        return [
            'rfq'     => true,
            'pcq'     => true,
            'fcq'     => has_approved_template_type( $this, 'pcq' ),
            'jcp'     => has_approved_template_type( $this, 'fcq' ),
            'po'      => has_approved_template_type( $this, 'fcq' ),
            'misc po' => has_approved_template_type( $this, 'fcq' ),
            'aa'      => has_approved_template_type( $this, 'fcq' ),
            'jcw'     => has_approved_template_type( $this, 'fcq' )
        ];
    }

    /**
     * @return array
     */
    public function getApprovalMapAttribute() {
        return [
            'rfq'     => has_approved_template_type( $this, 'rfq' ),
            'pcq'     => has_approved_template_type( $this, 'pcq' ),
            'fcq'     => has_approved_template_type( $this, 'fcq' ),
            'jcp'     => has_approved_template_type( $this, 'jcp' ),
            'po'      => has_approved_template_type( $this, 'po' ),
            'misc po' => has_approved_template_type( $this, 'misc po' ),
            'aa'      => has_approved_template_type( $this, 'aa' ),
            'jcw'     => has_approved_template_type( $this, 'jcw' )
        ];
    }

    public function getTotalCostAttribute() {
        $cost = 0.00;

        foreach ( $this->lines as $line ) {
            $cost += $line->unit_cost * $line->quantity;
        }

        return $cost;
    }

    public function getTotalPriceToClientAttribute() {
        $price = 0.00;

        foreach ( $this->lines as $line ) {
            $price += $line->unit_price * $line->quantity;
        }

        return $price;
    }

    public function getTotalProfitAttribute() {
        $cost = $this->getTotalCostAttribute();
        $price = $this->getTotalPriceToClientAttribute();

        return $price - $cost;
    }

    public function getTruePercentageProfitAttribute() {
        $cost = $this->getTotalCostAttribute();
        $profit = $this->getTotalProfitAttribute();

        return ( $profit / $cost ) * 100;
    }

    /**
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent( string $eventName ) : string {
        return "This project has been {$eventName}.";
    }

    public function getTitleAttribute($value) {
        if ( $value ) {
            return $value;
        }

        return 'Not Yet Titled';
    }

//    public function getClientAttribute($value) {
//        if ( $value ) {
//            return $value;
//        }
//
//        return [];
//    }

    /* ************************ MEDIA ************************* */

    /**
     * @return array|void
     * @throws \Brackets\Media\Exceptions\Collections\MediaCollectionAlreadyDefined
     */
    public function registerMediaCollections() {
        $this->addMediaCollection( 'jcp' )
             ->maxFileSize( 20 * 1024 * 1024 )
             ->maxNumberOfFiles( 1 );

        $this->addMediaCollection( 'jcp_supporting_files' );
        $this->addMediaCollection( 'official_files' );
    }

    /**
     * @param \Spatie\MediaLibrary\Media|null $media
     */
    public function registerMediaConversions( Media $media = null ) {
        $this->autoRegisterThumb200();
    }

    /* ************************ SCOPES ************************* */

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeApproved( $query ) {
        return $query->whereNotNull( 'approved_at' )
            ->whereStatus( 'OFFICIAL_VERSION' );
    }

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeUnapproved( $query ) {
        return $query->whereNull( 'approved_at' );
    }

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeRejected( $query ) {
        return $query->where( 'status', '=', 'REJECTED' );
    }

    /**
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeDrafts( $query ) {
        return $query->whereNotNull( 'base_project_id' )->withoutGlobalScope( 'published' );
    }

    /**
     * Another method name for "approved".
     *
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeOfficial( $query ) {
        return $this->scopeApproved( $query );
    }

    /**
     * Another method name for "unapproved".
     *
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeUnofficial( $query ) {
        return $this->scopeUnapproved( $query );
    }

    /**
     * Get the latest version of the requested type.
     * This is also the same as limiting by 1 and pulling
     * in descending order.
     *
     * @param $query Builder
     *
     * @return mixed Builder
     */
    public function scopeLatestVersion( $query ) {
        return $query->limit( 1 )
                     ->orderByDesc( 'approved_at' );
    }

    /**
     * @param $query Builder
     * @param $type  string
     *
     * @return mixed Builder
     */
    public function scopeWhereType( $query, $type ) {
        if ( null === $type ) {
            return $query;
        }

        return $query->where( 'template_type', '=', $type );
    }

    /**
     * @param $query  Builder
     * @param $status string
     *
     * @return mixed Builder
     */
    public function scopeWhereStatus( $query, $status ) {
        return $query->where( 'status', '=', $status );
    }

    /**
     * @param $query  Builder
     * @param $status array
     *
     * @return mixed Builder
     */
    public function scopeWhereStatusIn( $query, $status ) {
        return $query->whereIn( 'status', $status );
    }

    /**
     * @param $query  Builder
     * @param $status string
     *
     * @return mixed Builder
     */
    public function scopeWhereNotStatus( $query, $status ) {
        return $query->where( 'status', '!=', $status );
    }
}
