import {onFormReady} from '../../mixins/form';
import AppForm from '../app-components/Form/AppForm';

const config = {
    height: 200,
    inline: false,
    theme: 'modern',
    fontsize_formats: "8px 10px 12px 13px 14px 15px 16px 18px 20px 22px 24px 26px 28px 30px 34px 38px 42px 48px 54px 60px",
   plugins: 'print searchreplace autolink directionality advcode fullscreen image link media table charmap hr anchor toc insertdatetime advlist lists textcolor tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
    toolbar1: 'formatselect fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat  | code',
    image_advtab: true,
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    ],
};

Vue.component('email-template-form', {
    mixins: [AppForm, onFormReady],
    data: function() {
        return {
            config,
            form: {
                name:  '' ,
                header:  '' ,
                body:  '' ,
                footer:  '' ,
                published_at:  '' ,

            }
        }
    }

});
