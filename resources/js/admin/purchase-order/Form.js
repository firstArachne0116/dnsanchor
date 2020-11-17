import AppForm from '../app-components/Form/AppForm';

Vue.component('purchase-order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                project_id:  '' ,
                type:  '' ,
                vendor_id:  '' ,
                contact_id:  '' ,
                sales_representative_id:  '' ,
                approved_manager_id:  '' ,
                approval_requested_by:  '' ,
                template_type:  '' ,
                title:  '' ,
                quantity:  '' ,
                trim_size:  '' ,
                information_requests:  '' ,
                extent:  '' ,
                origination:  '' ,
                finishing_information:  '' ,
                packaging_information:  '' ,
                vendor_notes:  '' ,
                customer_shipping_to:  '' ,
                additional_comments:  '' ,
                remittance_id:  '' ,
                payment_term_id:  '' ,
                fob_at:  '' ,
                materials_in_at:  '' ,
                delivery_at:  '' ,
                approved_at:  '' ,
                
            }
        }
    }

});