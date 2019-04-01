$(function() {
    var base_url_ck = $('#base_url').val();
    
    tinymce.init({
        selector: ".ace-editer",
        theme: "modern",
        fontsize_formats: "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px",
        height: 350,
        relative_urls : false,
        remove_script_host: false,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
             "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
        ],
        content_css: "css/content.css",
        toolbar: "styleselect | fontselect | fontsizeselect | insertfile undo redo pastetext | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons", 
        style_formats: [
            {title: 'Headers', items: [
                {title: 'Header 1', format: 'h1'},
                {title: 'Header 2', format: 'h2'},
                {title: 'Header 3', format: 'h3'},
                {title: 'Header 4', format: 'h4'},
                {title: 'Header 5', format: 'h5'},
                {title: 'Header 6', format: 'h6'}
            ]},
            {title: 'Inline', items: [
                {title: 'Bold', icon: 'bold', format: 'bold'},
                {title: 'Italic', icon: 'italic', format: 'italic'},
                {title: 'Underline', icon: 'underline', format: 'underline'},
                {title: 'Strikethrough', icon: 'strikethrough', format: 'strikethrough'},
                {title: 'Superscript', icon: 'superscript', format: 'superscript'},
                {title: 'Subscript', icon: 'subscript', format: 'subscript'},
                {title: 'Code', icon: 'code', format: 'code'}
            ]},
            {title: 'Blocks', items: [
                {title: 'Paragraph', format: 'p'},
                {title: 'Blockquote', format: 'blockquote'},
                {title: 'Div', format: 'div'},
                {title: 'Pre', format: 'pre'}
            ]},
            {title: 'Alignment', items: [
                {title: 'Left', icon: 'alignleft', format: 'alignleft'},
                {title: 'Center', icon: 'aligncenter', format: 'aligncenter'},
                {title: 'Right', icon: 'alignright', format: 'alignright'},
                {title: 'Justify', icon: 'alignjustify', format: 'alignjustify'}
            ]},
            {title: 'Custom Menu', items: [
                {title : 'Button', selector : 'a', classes : 'button'}
            ]}
        ],
        external_filemanager_path: base_url_ck + "styles/assets/filemanager/",
        filemanager_title:"Filemanager Ace" ,
        filemanager_access_key:"7d6bc44b9495644c9fb9f706c8715ee5" ,
        external_plugins: { "filemanager" : base_url_ck + "styles/assets/filemanager/plugin.min.js"}
     }); 

    $('.iframe-btn').fancybox({ 
        'width'     : 900,
        'height'    : 500,
        'type'      : 'iframe',
        'autoScale' : false
    });
}); 