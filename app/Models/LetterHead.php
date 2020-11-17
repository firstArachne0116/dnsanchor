<?php namespace App\Models;

use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class LetterHead extends Model implements HasMediaCollections, HasMediaConversions
{

    use HasMediaCollectionsTrait, HasMediaThumbsTrait;

    protected $fillable = [
        'name',
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
    
    ];
    
    
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/letter-heads/'.$this->getKey());
    }

    /**
     * @return array|void
     * @throws \Brackets\Media\Exceptions\Collections\MediaCollectionAlreadyDefined
     */
    public function registerMediaCollections() {
        $this->addMediaCollection( 'letterhead' )
             ->accepts( 'image/*' )
             ->maxFileSize( 30 * 1024 * 1024 )
             ->maxNumberOfFiles( 1 );
    }

    /**
     * @param \Spatie\MediaLibrary\Media|null $media
     */
    public function registerMediaConversions( Media $media = null ) {
        $this->autoRegisterThumb200();
    }
    
}
