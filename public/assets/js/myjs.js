$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.selectpicker').selectpicker();
    $("#brand_submit").submit(function(e){
        e.preventDefault(); 
        var name=$("#name").val();
        var logo=$("#logo")[0].files[0];
        var title=$("#title").val();
        var description=$("#description").val();
        var formData=new FormData();
        formData.append('name',name);
        formData.append('logo',logo);
        formData.append('title',title);
        formData.append('description',description);
     
        // var data=$(this).serialize();
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/brands/save";
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    $('#image-error').append( '<div  class="animated fadeInDown" style="display: block;">'+response.error+'</div>');
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#editbrandshow", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        var cat_id=$('#eid').val(data[0]).val();
        var brand_img="#brand_img"+cat_id;
        var dataimg=$(brand_img).attr("src");
        $('#eid').val(data[0]);
        $('#ename').val(data[1]);
        $('#elogo').attr("src",dataimg);
        $('#etitle').val(data[3]);
        $('#edescription').val(data[4]);
    
        $("#edit-brand").modal('show');
        
     
    });
    
    $("#brand_edit").submit(function(e){
        e.preventDefault(); 
        var eid=$("#eid").val();
        var ename=$("#ename").val();
        var elogoup=$("#elogoup")[0].files[0];
        var etitle=$("#etitle").val();
        var edescription=$("#edescription").val();
        var formData=new FormData();
        formData.append('id',eid);
        formData.append('name',ename);
        formData.append('logo',elogoup);
        formData.append('title',etitle);
        formData.append('description',edescription);
        
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/brands/edit/save/"+eid;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                
                    $('#image-uperror').append( '<div  class="animated fadeInDown" style="display: block;">'+response.error+'</div>');
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#brand_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#brand_action_delete").modal('show');
    });
    
    $("#brand_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/brands/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#brand_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
        $("#brand_action_active").modal('show');
    });
    
    $("#brand_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/brands/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#brand_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#brand_action_deactive").modal('show');
    });
    
    $("#brand_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/brands/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#category_submit").submit(function(e){
        e.preventDefault(); 
        
        var first_category=$("#first_category").val();
        var second_category=$("#second_category").val();
        var category_logo=$("#category_logo")[0].files[0];
        var category_title=$("#category_title").val();
        var category_description=$("#category_description").val();
        var formData=new FormData();
        formData.append('first_category',first_category);
        formData.append('second_category',second_category);
        formData.append('category_logo',category_logo);
        formData.append('category_title',category_title);
        formData.append('category_description',category_description);
        console.log(first_category);
        console.log(second_category);
        console.log(category_logo);
        console.log(category_title);
        console.log(category_description);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/category/save";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                   
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#editcategoryshow", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        var cat_id=$('#eid').val(data[0]).val();
        var cat_img="#category_img"+cat_id;
        var dataimg=$(cat_img).attr("src");
        $('#efirst_category').val(data[1]);
        // $('#cat_option').val(data[2]);
        $('#elogo').attr("src",dataimg);
        $('#ecategory_title').val(data[4]);
        $('#ecategory_description').val(data[5]);
        $("#edit-category").modal('show');
    });
    
    $("#category_edit").submit(function(e){
        e.preventDefault(); 
        var eid=$("#eid").val();
        var category_name=$("#efirst_category").val();
        var parent_id=$("#esecond_category").val();
        var elogoup=$("#ecategory_logo")[0].files[0];
        var etitle=$("#ecategory_title").val();
        var edescription=$("#ecategory_description").val();
        
        var formData=new FormData();
        formData.append('id',eid);
        formData.append('category_name',category_name);
        formData.append('parent_id',parent_id);
        formData.append('logo',elogoup);
        formData.append('title',etitle);
        formData.append('description',edescription);
        
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/category/edit/save/"+eid;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    $('#image-uperror').append( '<div  class="animated fadeInDown" style="display: block;">'+response.error+'</div>');
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#category_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#category_action_deactive").modal('show');
    });
    
    $("#category_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/category/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#category_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
        $("#category_action_active").modal('show');
    });
    
    $("#category_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/category/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("click","#category_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#category_action_delete").modal('show');
    });
    
    $("#category_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/category/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
       
        
    
    
    
    
        // $('').css('height', '700');
    
      
       
    
        // Change this to the location of your server-side upload handler:
        var max_uploads = 5;
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/image/upload";                                                
        $('#fileupload').fileupload({
            url: get_location,
            dataType: 'html',
            done: function (e, data) {
    
                if(data['result'] == 'FAILED'){
                    alert('Invalid File');
                }else{
                    $('#uploaded_file_name').val(data['result']);
                    $('#uploaded_images').append('<div style="float:left;position: relative;margin-left:88px;"> <input type="text" value="'+data['result']+'" name="uploaded_image_name[]" id="uploaded_image_name" hidden> <img  class="img_rmv" style="width:700%;position: absolute; cursor:pointer;" src="'+get_protocol+'//'+get_host+'/assets/images/product/'+data['result']+'" /> <a class="img_rmv" style="z-index:1"  href="#"><i class="fa fa-times-circle"></i></a> </div>');
    
                    if($('.uploaded_image').length >= max_uploads){
                        $('#select_file').hide();
                    }else{
                        $('#select_file').show();
                    }
                }
                
                $('#progress .progress-bar').css(
                    'width',
                    0 + '%'
                );
    
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });
    
            },
        
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
                
            }
            
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    $( "#uploaded_images" ).on( "click", ".img_rmv", function() {
        $(this).parent().remove();
        if($('.uploaded_image').length >= max_uploads){
            $('#select_file').hide();
        }else{
            $('#select_file').show();
        }
    });
    
    
    // edit product
    
     
    
    
    
    
    
    
    var max_uploads = 5;
    var get_protocol=location.protocol;
    var get_host=location.host;
    var get_location=get_protocol+"//"+get_host+"/be/welcome/product/image/upload";                                                
    $('#sellerfileupload').fileupload({
        url: get_location,
        dataType: 'html',
        done: function (e, data) {
    
            if(data['result'] == 'FAILED'){
                alert('Invalid File');
            }else{
                $('#uploaded_file_name').val(data['result']);
                $('#uploaded_images').append('<div style="float:left;position: relative;margin-left:88px;"> <input type="text" value="'+data['result']+'" name="uploaded_image_name[]" id="uploaded_image_name" hidden> <img  class="img_rmv" style="width:700%;position: absolute; cursor:pointer;" src="'+get_protocol+'//'+get_host+'/assets/images/product/'+data['result']+'" /> <a class="img_rmv" style="z-index:1"  href="#"><i class="fa fa-times-circle"></i></a> </div>');
    
                if($('.uploaded_image').length >= max_uploads){
                    $('#select_file').hide();
                }else{
                    $('#select_file').show();
                }
            }
            
            $('#progress .progress-bar').css(
                'width',
                0 + '%'
            );
    
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
    
        },
    
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
            
        }
        
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    $( "#uploaded_images" ).on( "click", ".img_rmv", function() {
    $(this).parent().remove();
    if($('.uploaded_image').length >= max_uploads){
        $('#select_file').hide();
    }else{
        $('#select_file').show();
    }
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $(document).on("click","#product_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#product_action_delete").modal('show');
    });
    $("#product_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#featured_product_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#efa_id').val(data[0]);
        $("#featured_product_action_active").modal('show');
    });
    
    $("#featured_product_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#efa_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/featured/product/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#featured_product_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#efda_id').val(data[0]);
        $("#featured_product_action_deactive").modal('show');
    });
    
    $("#featured_product_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#efda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/featured/product/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#product_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
        $("#product_action_active").modal('show');
    });
    $("#product_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#product_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#product_action_deactive").modal('show');
    });
    $("#product_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    
    $(document).on("click","#blog_show", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
    
        var blog_id=$('#eid').val(data[0]).val();
        var cat_img="#blog_img"+blog_id;
        var dataimg=$(cat_img).attr("src");
        $('#elogo').attr("src",dataimg);
        $('#etitle').val(data[2]);
    
        $('#edescription').val(data[3]);
       
    
        $("#edit-blog").modal('show'); 
     
    });
    $("#blog_submit_form").submit(function(e){
        e.preventDefault(); 
        var logo=$("#logo")[0].files[0];
        var title=$("#title").val();
        var description=$("#description").val();
        var formData=new FormData();
        formData.append('logo',logo);
        formData.append('title',title);
        formData.append('description',description);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/blog/save";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#blog_edit_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eid").val();
        var image=$("#elogoup")[0].files[0];
        var etitle=$("#etitle").val();
        var edescription=$("#edescription").val();
    
        var formData=new FormData();
        formData.append('id',id);
        formData.append('logo',image);
        formData.append('title',etitle);
        formData.append('description',edescription);
    
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/blog/edit/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#blog_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#blog_action_deactive").modal('show');
    });
    
    $("#blog_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/blog/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    
    $(document).on("click","#flashdeal_product_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#flashdeal_product_action_deactive").modal('show');
    });
    
    $("#flashdeal_product_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/flash/product/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#flashdeal_product_active", function(e){
        e.preventDefault();
        
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
     
        $("#flashdeal_product_action_active").modal('show');
    });
    
    $("#flashdeal_product_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
       
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/flash/product/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#flashdeal_product_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#flashdeal_product_action_delete").modal('show');
    });
    
    $("#flashdeal_product_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/flash/product/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#staff_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
        $("#staff_action_active").modal('show');
    });
    
    $("#staff_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/allstaffs/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#staff_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#staff_action_deactive").modal('show');
    });
    
    $("#staff_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/allstaffs/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#staff_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#staff_action_delete").modal('show');
    });
    
    $("#staff_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/allstaffs/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#staff_edit", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        var selected_value = "0";
        var staff_role=$('#staff_role_show').val(data[3]).val();
        $('#staff_edit_action').find("#staff_role").find('option').not(':first').remove();
        var selectbox_options = '<option value="0">'+staff_role+'</option>';
        $('#staff_edit_id').val(data[0]);
        $('#staff_name').val(data[1]);
        $('#staff_email').val(data[2]);
        $('#staff_phone').val(data[3]);
        $('#staff_edit_action').find('#staff_role').append(selectbox_options).val(selected_value).trigger('change');
        $("#staff_edit_action").modal('show');
    });
    
    $("#staff_edit_action_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#staff_edit_id").val();
        var name=$("#staff_name").val();
        var email=$("#staff_email").val();
        var phone=$("#staff_phone").val();
        var password=$("#staff_password").val();
        var role=$("#staff_role").val();
    
        var formData=new FormData();
     
        formData.append('id',id);
        formData.append('name',name);
        formData.append('email',email);
        formData.append('phone',phone);
        formData.append('password',password);
        formData.append('role',role);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/allstaffs/edit/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#role_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#role_action_delete").modal('show');
    });
    
    $("#role_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/delete/role/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#customer_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#customer_action_delete").modal('show');
    });
    
    $("#customer_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/delete/customer/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#order_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#order_action_delete").modal('show');
    });
    
    $("#order_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/order/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#payment_status_admin").on('change',function(e){
        e.preventDefault(); 
        var id=$("#payment_status_admin").attr("name");
        var pay=$("#payment_status_admin").val();
        var formData=new FormData();
        formData.append('id',id);
        formData.append('pay',pay);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/order/payment/status/update/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#delivery_status_admin").on('change',function(e){
        e.preventDefault(); 
        var id=$("#delivery_status_admin").attr("name");
        var delivery=$("#delivery_status_admin").val();
        var formData=new FormData();
        formData.append('id',id);
        formData.append('delivery',delivery);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/order/delivery/status/update/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    // console.log(response.url);
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#coupon_type").on('change',function(e){
        var value=$(this).val();
        if(value==1)
        {
            $('#e_date').attr('name', 'e_date');
            $('#s_date').attr('name', 's_date');
            $('.coupon_display_none').show();
            $(".single-select").select2({ width: 'resolve' }); 
        }else{
            $('.coupon_display_none').hide();
        }    
    });
    
    $(document).on("click","#coupon_product_add_more", function(e){
        e.preventDefault();
        var category ='';
        var sub_category ='';
        var product ='';
        $("#coupon_category option").each(function()
        {
            category += "<option value="+$(this).val()+">"+$(this).text()+"</option>";
        });
        $("#coupon_subcategory option").each(function()
        {
            sub_category += "<option value="+$(this).val()+">"+$(this).text()+"</option>";
        });
        $("#coupon_product option").each(function()
        {
            product += "<option value="+$(this).val()+">"+$(this).text()+"</option>";
        });
        var add_more='<div style="border-top: 1px solid #eee; margin-bottom: 5px;"><div class="form-group row"><label class="col-lg-2 col-form-label" for="amount">Category</label><div class="col-lg-6"><select name="category[]"  class="col-lg-12 form-control single-select">'+category+'</select><div  class="invalid-feedback animated fadeInDown" style="display: block;"></div></div></div><div class="form-group row"><label class="col-lg-2 col-form-label" for="amount">Sub Category</label><div class="col-lg-6"><select name="subcategory[]"  class="col-lg-12 form-control single-select">'+sub_category+'</select><div  class="invalid-feedback animated fadeInDown" style="display: block;"></div></div></div><div class="form-group row"><label class="col-lg-2 col-form-label" for="amount">Product</label><div class="col-lg-6"><select name="product[]"  class="col-lg-12 form-control single-select">'+product+'</select><div  class="invalid-feedback animated fadeInDown" style="display: block;"></div></div></div></div>'
        $("#after_this").append(add_more);
        $('.single-select ').select2({
            tags: true,
            allowClear: true,
            width: '100%'
          });
    });
    
    $("#coupon_type").on('change',function(e){
        var value=$(this).val();
        if(value==2)
        {
            $('#e_date').removeAttr('name');
            $('#s_date').removeAttr('name');
            $('.coupon_total_order_none').show();
        }else{
            $('.coupon_total_order_none').hide();
        }    
    });
    
    
    $("#flash_deal_product").on('change',function(e){
        e.preventDefault(); 
        $(".discount_product").show();
        var id=$("#flash_deal_product").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/flashdeal/getproduct/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    if($("#flash_deal_type").val==1)
                    {
                        var add_more='<tr><td>'+response.product['name']+'</td><td>'+response.product['unit_price']+'</td><td><input required value="'+response.product['discount']+'" type="text" class="form-control" placeholder="Upto 100%..."  name="discount[]"></td></tr>'
                        $("#more_flash_product").append(add_more);
                    }else{
                        var add_more='<tr><td>'+response.product['name']+'</td><td>'+response.product['unit_price']+'</td><td><input required value="" type="text" class="form-control" placeholder=""  name="discount[]"></td></tr>'
                        $("#more_flash_product").append(add_more);
                    }
                   
                }
            },
            error:function(error){
                console.log(error);
            }
        });
    });
    
    $("#slider_submit").submit(function(e){
        e.preventDefault(); 
        var image=$("#slider_image")[0].files[0];
        var formData=new FormData();
        formData.append('image',image);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/add/slider";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#slider_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#slider_delete_action").modal('show');
    });
    
    $("#slider_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/slider/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#slider_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#slider_active_action").modal('show');
    });
    
    $("#slider_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/slider/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#slider_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
        $("#slider_deactive_action").modal('show');
    });
    
    $("#slider_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/slider/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#banner1_submit").submit(function(e){
        e.preventDefault();
        var position=1;
        var url=$("#banner1_url").val();
        var image=$("#banner1_image")[0].files[0];
        var description=$("#description").val();
        var formData=new FormData();
        formData.append('position',position);
        formData.append('url',url);
        formData.append('image',image);
        formData.append('description',description);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/add/banner";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#banner2_submit").submit(function(e){
        e.preventDefault();
        var position=2;
        var url=$("#banner2_url").val();
        var image=$("#banner2_image")[0].files[0];
        var formData=new FormData();
        formData.append('position',position);
        formData.append('url',url);
        formData.append('image',image);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/add/banner";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    $(document).on("click","#banner1_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eod_id').val(data[0]);
        $("#banner1_delete_action").modal('show');
    });
    $(document).on("click","#banner2_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#etd_id').val(data[0]);
        $("#banner2_delete_action").modal('show');
    });
    
    $("#banner1_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eod_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/banner/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#banner2_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#etd").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/banner/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    $(document).on("click","#banner1_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eoda_id').val(data[0]);
        $("#banner1_active_action").modal('show');
    });
    $(document).on("click","#banner2_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#etda_id').val(data[0]);
        $("#banner2_active_action").modal('show');
    });
    
    $("#banner1_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eoda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/banner/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#banner2_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#etda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/banner/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    $(document).on("click","#banner1_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eoa_id').val(data[0]);
        $("#banner1_deactive_action").modal('show');
    });
    $(document).on("click","#banner2_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eta_id').val(data[0]);
        $("#banner2_deactive_action").modal('show');
    });
    
    $("#banner1_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eoa").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/banner/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#banner2_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eta").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/banner/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#usefullink_create_action_submit").submit(function(e){
        e.preventDefault();
        var name=$("#usefullink_name").val();
        var url=$("#usefullink_link").val();
        var formData=new FormData();
        formData.append('name',name);
        formData.append('url',url);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/create/usefullink/";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#usefullink_edit", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#usefullink_edit_id').val(data[0]);
        $('#usefullink_edit_name').val(data[1]);
        $('#usefullink_edit_link').val(data[2]);
        $("#usefullink_edit_action").modal('show');
    });
    
    // $("#usefullink_edit_action_submit").submit(function(e){
    //     e.preventDefault(); 
    //     var id=$("#banner1_active").attr("class");
    //     var formData=new FormData();
    //     formData.append('id',id);
    //     var get_protocol=location.protocol;
    //     var get_host=location.host;
    //     var get_location=get_protocol+"//"+get_host+"/admin/welcome/banner/deactive/"+id;                                                      
    //     $.ajax({
    //         url:get_location,
    //         dataType : 'json',
    //         method:'GET',
    //         data:formData,
    //         processData:false,
    //         contentType:false,
    //         success:function(response){
    //             if(response.val_error=="ok")
    //             {
                    
    //             }
    //             else if(response.success=="ok")
    //             {
    //                 window.location=response.url;
    //             }
    //         },
    //         error:function(error){
    //             console.log(error);
    //         }
    //     });
      
    // });
    
    $("#usefullink_edit_action_submit").submit(function(e){
        e.preventDefault();
        var id=$("#usefullink_edit_id").val();
        var name=$("#usefullink_edit_name").val();
        var url=$("#usefullink_edit_link").val();
        var formData=new FormData();
        formData.append('id',id);
        formData.append('name',name);
        formData.append('url',url);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/edit/usefullink/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#usefullink_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#usefullink_delete_action").modal('show');
    });
    
    $("#usefullink_delete_action_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/usefullink/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    var click_increment=1;
    $(document).on("click","#add_more_customer_choice_option", function(e){
        e.preventDefault();
        var add_more_choice=$(this).attr("class");
        if(add_more_choice!="")
        {
            var clicks = add_more_choice;
        }else{
            var clicks = 1+click_increment;
        }
    
        var customer_choice ='';
        customer_choice += "<option value="+$(this).val()+">"+$(this).text()+"</option>";
        var add_more='<div style="width: 20%;float:left"><div class="form-group"><input style="height: 36px;padding-left:5px" type="text" multiple="multiple" name="option_head[]" placeholder="Choice title"></div></div><div id="after_head" style="width: 80%;float:left"><div class="form-group"><select name="option_content_'+clicks+'[]" multiple="multiple" style="width:100%"    class="form-control dynamic-option-creation"><option >eee</option></select></div></div>'
        $("#after_head").append(add_more);
        
        $('.dynamic-option-creation').select2({
            tags: true,
            allowClear: true,
            width: '100%'
          });
        clicks++;
        click_increment++;
    });
    
    // $("#product_category").change(function(){
    //     var category=$(this).val();
    //     var options="<option value='0'>Select Child Category</option>";
    //     var get_protocol=location.protocol;
    //     var get_host=location.host;
    //     var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/subcategory/"+category;
    //     $.get(get_location,
    //         function(data)
    //         {
    //             data=JSON.parse(data);
    //             data.forEach(element => {
    //                 options+="<option value='"+element.id+"'>"+element.name+"</option>";
    //             });
    //             $("#product_child_category").html(options);
    //         });
    // });
    
    $("#product_category").change(function(e){
        e.preventDefault(); 
        var category=$(this).val();
        var options="<option value='0'>Select Child Category</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/subcategory/"+category;
        var formData=new FormData();
        formData.append('id',category);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    $.each(response.sub_category, function(k, v) {
                        options+="<option value='"+v.id+"'>"+v.name+"</option>";
                    });
                    $("#product_child_category").html(options);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#customer_product_category").change(function(e){
        e.preventDefault(); 
        var category=$(this).val();
        var options="<option value='0'>Select Child Category</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/be/welcome/product/subcategory/"+category;
        var formData=new FormData();
        formData.append('id',category);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    $.each(response.sub_category, function(k, v) {
                        options+="<option value='"+v.id+"'>"+v.name+"</option>";
                    });
                    $("#product_child_category").html(options);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#coupon_category").change(function(e){
        e.preventDefault(); 
        var category=$(this).val();
        var options="<option value='0'>Select Child Category</option>";
        var options_product="<option value='0'>Select Product</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/product/subcategory/"+category;
        var formData=new FormData();
        formData.append('id',category);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    $.each(response.sub_category, function(k, v) {
                        options+="<option value='"+v.id+"'>"+v.name+"</option>";
                    });
                    $.each(response.product, function(k, v) {
                        options_product+="<option value='"+v.id+"'>"+v.name+"</option>";
                    });
                    $("#coupon_subcategory").html(options);
                    $("#coupon_product").html(options_product);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    $("#coupon_subcategory").change(function(e){
        e.preventDefault(); 
        var category=$(this).val();
        var options="<option value='0'>Select Child Category</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/get/product/"+category;
        var formData=new FormData();
        formData.append('id',category);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    $.each(response.product, function(k, v) {
                        options+="<option value='"+v.id+"'>"+v.name+"</option>";
                    });
                    console.log(options);
                    $("#coupon_product").html(options);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    
    
    $("#supplier_list_submit").submit(function(e){
        e.preventDefault(); 
        var code=$("#code").val();
        var group=$("#group").val();
        var name=$("#name").val();
        var phone=$("#phone").val();
        var email=$("#email").val();
        var address=$("#address").val();
    
        var formData=new FormData();
        formData.append('code',code);
        formData.append('group',group);
        formData.append('name',name);
        formData.append('phone',phone);
        formData.append('email',email);
        formData.append('address',address);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/supplierlist/submit";
        
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#supplier_list_edit", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#e_id').val(data[0]);
        $('#e_code').val(data[1]);
        $('#e_name').val(data[2]);
        $('#e_address').val(data[4]);
        $('#e_phone').val(data[5]);
        $('#e_email').val(data[6]);
        $('#e_group').val(data[7]);
        
        $("#supplier_list_edit_show").modal('show');
    });
    
    $("#supplier_list_edit_submit").submit(function(e){
        e.preventDefault();
        var id=$("#e_id").val();
        var code=$("#e_code").val();
        var group=$("#e_group").val();
        var name=$("#e_name").val();
        var phone=$("#e_phone").val();
        var email=$("#e_email").val();
        var address=$("#e_address").val();
    
        var formData=new FormData();
        formData.append('id',id);
        formData.append('code',code);
        formData.append('group',group);
        formData.append('name',name);
        formData.append('phone',phone);
        formData.append('email',email);
        formData.append('address',address);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/supplierlist/edit/submit/"+id;
        
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("click","#supplierlist_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#supplierlist_action_delete").modal('show');
    });
    
    $("#supplierlist_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/supplierlist/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#supplierlist_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
        $("#supplierlist_action_deactive").modal('show');
    });
    $("#supplierlist_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        formData.append('id',id);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/supplier/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    $(document).on("click","#supplierlist_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#supplierlist_action_active").modal('show');
    });
    $("#supplierlist_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/supplier/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    $("#inproduct_submit").submit(function(e){
        e.preventDefault(); 
        var name=$("#name").val();
        var image=$("#logo")[0].files[0];
        var current_location=$("#current_location").val();
        var quentity=$("#quentity").val();
        var price=$("#price").val();
        var depreciation=$("#depreciation").val();
      
        var formData=new FormData();
    
        formData.append('name',name);
        formData.append('image',image);
        formData.append('current_location',current_location);
        formData.append('quentity',quentity);
        formData.append('price',price);
        formData.append('depreciation',depreciation);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/inproduct/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#inproduct_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#inproduct_delete_show").modal('show');
    });
    
    $("#inproduct_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/inproduct/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#editinproductshow", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
    
        var id=$('#eid').val(data[0]).val();
        var img="#inhouse_img"+id;
        var dataimg=$(img).attr("src");
        $('#elogo').attr("src",dataimg);
        $('#ename').val(data[1]);
        // $('#equentity').val(data[3]);
        $('#ecurrent_location').val(data[4]);
        $("#edit-inproduct").modal('show'); 
    });
    
    $("#inproduct_edit_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eid").val();
        var name=$("#ename").val();
        var image=$("#enlogo")[0].files[0];
        var current_location=$("#ecurrent_location").val();
        var quentity=$("#equentity").val();
        var add_price=$("#add_price").val();
    
        var order_quentity=$("#order_quentity").val();
        var order_by=$("#order_by").val();
        var id_no=$("#id_no").val();
        var comment=$("#comment").val();
      
        var formData=new FormData();
    
        formData.append('name',name);
        formData.append('image',image);
        formData.append('current_location',current_location);
        formData.append('quentity',quentity);
        formData.append('add_price',add_price);
        formData.append('order_quentity',order_quentity);
        formData.append('order_by',order_by);
        formData.append('id_no',id_no);
        formData.append('comment',comment);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/inproduct/update/submit/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#be_seller_option").on('change',function(e){
        e.preventDefault(); 
      
        var id=$("#be_seller_option").attr("name");
        var value=$("#be_seller_option").val();
        var formData=new FormData();
        formData.append('id',id);
        formData.append('value',value);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/be/seller/application/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("change","#purchase_product_price", function(e){
        e.preventDefault();
        var quantity=$("#quantity").val();
        var amount=$("#purchase_product_price").val();
        var amount_str =String(amount);
        var amount_arr=new Array();
        var amount_arr=amount_str.split(',');
    
        var quantity_str =String(quantity);
        var quantity_arr=new Array();
        var quantity_arr=quantity_str.split(',');
        var total_price=0;
        for(var i=0; i<amount_arr.length;i++)
        {
            total_price=total_price+ amount_arr[i]*quantity_arr[i];
            $('#total_purchase_product_amount').attr('value', total_price);
        }
    });
    
    $("#purchase_product_submit").submit(function(e){
        e.preventDefault(); 
        var date=$("#s_date").val();
        var name=$("#name").val();
        var order_id=$("#order_id").val();
        var amount=$("#purchase_product_price").val();
        var amount_pay=$("#price_pay").val();
        var chalan=$("#chalan").val();
        var category=$("#purchase_product_category").val();
        var item_code=$("#product_name").val();
        var quantity=$("#quantity").val();
        var formData=new FormData();
    
        formData.append('date',date);
        formData.append('name',name);
        formData.append('order_id',order_id);
        formData.append('amount',amount);
        formData.append('amount_pay',amount_pay);
        formData.append('chalan',chalan);
        formData.append('category',category);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
    
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/purchase/product/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#purchaseproduct_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[0]);
        $("#purchaseproduct_action_active").modal('show');
    });
    $("#purchaseproduct_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/purchase/product/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#purchaseproduct_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[0]);
        $("#purchaseproduct_action_deactive").modal('show');
    });
    $("#purchaseproduct_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/purchase/product/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("click","#purchaseproduct_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#purchaseproduct_action_delete").modal('show');
    });
    $("#purchaseproduct_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/purchase/product/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#purchase_product_category").change(function(e){
        e.preventDefault(); 
        var category=$(this).val();
        var options="";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/purchase/product/category/"+category;
        var formData=new FormData();
        formData.append('id',category);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                        var name=response.name;
                        var id=response.id;
                  
                        var name_str =String(name);
                      
                        var name_arr=new Array();
                      
                        var name_arr=name_str.split(',');
                        var id_str=id.split(',');
                      
                       
                        for(var i=0;i<name_arr.length;i++)
                        {
                            options+="<option value="+id_str[i]+">"+name_arr[i]+"</option>";
                        }
                        $('#product_name')
                        .empty()
                        .append(options);
                      
                    
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#epurchase_product_category").change(function(e){
        e.preventDefault(); 
        var category=$(this).val();
        var options="";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/purchase/product/category/"+category;
        var formData=new FormData();
        formData.append('id',category);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                        var name=response.name;
                        var id=response.id;
                  
                        var name_str =String(name);
                      
                        var name_arr=new Array();
                      
                        var name_arr=name_str.split(',');
                        var id_str=id.split(',');
                      
                       
                        for(var i=0;i<name_arr.length;i++)
                        {
                            options+="<option value="+id_str[i]+">"+name_arr[i]+"</option>";
                        }
                        $('#epurchase_product_name')
                        .empty()
                        .append(options);
                      
                    
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#bank_cheque_register_submit").submit(function(e){
        e.preventDefault(); 
        var bank_ledger_name=$("#bank_ledger_name").val();
        var ledger_name=$("#ledger_name").val();
        var voucher_no=$("#voucher_no").val();
        var gene_date=$("#gene_date").val();
        var issue_date=$("#issue_date").val();
        var cheque_no=$("#cheque_no").val();
        var chq_date=$("#chq_date").val();
        var b_amount=$("#b_amount").val();
        var formData=new FormData();
        formData.append('bank_ledger_name',bank_ledger_name);
        formData.append('ledger_name',ledger_name);
        formData.append('voucher_no',voucher_no);
        formData.append('gene_date',gene_date);
        formData.append('issue_date',issue_date);
        formData.append('cheque_no',cheque_no);
        formData.append('chq_date',chq_date);
        formData.append('b_amount',b_amount);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/bank/cheque/register/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#bankcheque_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[0]);
        $("#bankcheque_action_delete").modal('show');
    });
    $("#bankcheque_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/bank/cheque/register/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $(document).on("click","#more_voucher_submit", function(e){
        e.preventDefault();
        var head="";
        $("#head option").each(function()
        {
            head += "<option value="+$(this).val()+">"+$(this).text()+"</option>";
        });
        var add_more='<div class="row" id="more_more"><div class="form-group col-md-12"><div ><input readonly type="text" class="form-control" placeholder="New Entry..." value=""></div></div> <div class="form-group col-md-6"><label class="col-form-label" for="name">Particular <span class="text-danger">*</span></label><div ><input required type="text" class="form-control"  id="particular" name="particular[]" placeholder="Enter a particular..." value=""></div></div><div class="form-group col-md-6"><label class="col-form-label" for="name">Head<span class="text-danger">*</span></label><select required name="head[]" class="form-control">'+head+'</select></div><div class="form-group col-md-6"><label class="col-form-label" for="name">Dr.</label><div ><input  type="text" class="form-control dr"  id="dr" name="dr[]" placeholder="" value=""></div></div><div class="form-group col-md-6" ><label class="col-form-label" for="name">Cr.</label><div ><input  type="text" class="form-control cr"  id="cr" name="cr[]" placeholder="" value=""></div></div></div>';
        $("#after_this").append(add_more);
    });
    $(document).on("click","#remove_voucher_submit", function(e){
        e.preventDefault();
        $('#after_this #more_more').last().remove();
    });
    $(document).on("change",".dr", function(e){
        e.preventDefault();
        var dr = []
        var total_dr=0;
        $('.dr').each(function () {
            dr.push($(this).val())
        })
        dr = dr.filter(item => item);
        for(var i=0; i<dr.length;i++)
        {
            total_dr=total_dr + parseInt(dr[i]);
            $('#t_dr').attr('value', total_dr);
        }
    });
    
    $(document).on("change",".cr", function(e){
        e.preventDefault();
        var cr = []
        var total_cr=0;
        $('.cr').each(function () {
            cr.push($(this).val())
        })
        cr = cr.filter(item => item);
        for(var i=0; i<cr.length;i++)
        {
            total_cr=total_cr + parseInt(cr[i]);
            $('#t_cr').attr('value', total_cr);
        }
    });
    
    
    
    
    
    
    $(document).on("click","#voucher_active", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ea_id').val(data[1]);
        $("#account_voucher_action_active").modal('show');
    });
    
    $("#account_voucher_action_active_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ea_id").val();
        var formData=new FormData();
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/voucher/deactive/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("click","#voucher_deactive", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eda_id').val(data[1]);
        $("#account_voucher_action_deactive").modal('show');
    });
    
    $("#account_voucher_action_deactive_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#eda_id").val();
        var formData=new FormData();
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/voucher/active/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("click","#account_voucher_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#ed_id').val(data[1]);
        $("#account_voucher_action_delete").modal('show');
    });
    
    $("#account_voucher_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#ed_id").val();
        var formData=new FormData();
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/voucher/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(".layer_two").hide();
    $(".layer_three").hide();
    $(".layer_four").hide();
    $(".layer_five").hide();
    $(".layer_head").hide();
    
    $("#layer_one").change(function(e){
        e.preventDefault(); 
        var id=$(this).val();
        var options="<option disabled selected>Select account group</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/group/layerone/"+id;
        var formData=new FormData();
        formData.append('id',id);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
          
                if(response.success=="ok")
                {
                        $.each(response.layer_two, function(k, v) {
                            options+="<option value='"+v.id+"'>"+v.name+"</option>";
                        });
                        $("#layer_two").html(options);
                        $(".layer_two").show();
                }else{
                    $(".layer_two").hide();
                    $(".layer_three").hide();
                    $(".layer_four").hide();
                    $(".layer_five").hide();
    
                    $("#layer_two").html("");
                    $("#layer_three").html("");
                    $("#layer_four").html("");
                    $("#layer_five").html("");
                    $("#layer_head").html("");
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#layer_two").change(function(e){
        e.preventDefault(); 
        var id=$(this).val();
        var options="<option disabled selected>Select account group</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/group/layertwo/"+id;
        var formData=new FormData();
        $(".layer_head").show();
        formData.append('id',id);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
          
                if(response.success=="ok")
                {
                        $.each(response.layer_three, function(k, v) {
                            options+="<option value='"+v.id+"'>"+v.name+"</option>";
                        });
                        $("#layer_three").html(options);
                        $(".layer_three").show();
                }else{
                    $(".layer_three").hide();
                    $(".layer_four").hide();
                    $(".layer_five").hide();
    
                    $("#layer_three").html("");
                    $("#layer_four").html("");
                    $("#layer_five").html("");
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#layer_three").change(function(e){
        e.preventDefault(); 
        var id=$(this).val();
        var options="<option disabled selected>Select account group</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/group/layerthree/"+id;
        var formData=new FormData();
        $(".layer_head").show();
        formData.append('id',id);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
          
                if(response.success=="ok")
                {
                        $.each(response.layer_four, function(k, v) {
                            options+="<option value='"+v.id+"'>"+v.name+"</option>";
                        });
                        $("#layer_four").html(options);
                        $(".layer_four").show();
                }else{
                    $(".layer_four").hide();
                    $(".layer_five").hide();
    
                    $("#layer_four").html("");
                    $("#layer_five").html("");
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#layer_four").change(function(e){
        e.preventDefault(); 
        var id=$(this).val();
        var options="<option disabled selected>Select account group</option>";
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/group/layerfour/"+id;
        var formData=new FormData();
        $(".layer_head").show();
        formData.append('id',id);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
          
                if(response.success=="ok")
                {
                        $.each(response.layer_five, function(k, v) {
                            options+="<option value='"+v.id+"'>"+v.name+"</option>";
                        });
                        $("#layer_five").html(options);
                        $(".layer_five").show();
                }else{
                    $(".layer_five").hide();
                    $("#layer_five").html("");
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#account_group_submit").submit(function(e){
        e.preventDefault(); 
        var layer_one=$("#layer_one").val();
        var layer_two=$("#layer_two").val();
        var layer_three=$("#layer_three").val();
        var layer_four=$("#layer_four").val();
        var layer_five=$("#layer_five").val();
        var head=$("#layer_head").val();
        
        var note=$("#note").val();
    
        var formData=new FormData();
    
        formData.append('layer_one',layer_one);
        formData.append('layer_two',layer_two);
        formData.append('layer_three',layer_three);
        formData.append('layer_four',layer_four);
        formData.append('layer_five',layer_five);
        formData.append('head',head);
        formData.append('note',note);
        
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/group/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.success=="ok")
                {
                    // console.log(response.url);
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#adjustment_product_submit").submit(function(e){
        e.preventDefault(); 
        var date=$("#s_date").val();
        var category=$("#purchase_product_category").val();
        var item_code=$("#product_name").val();
        var order_id=$("#order_id").val();
        var quantity=$("#quantity").val();
        var reason=$("#reason").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_id',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        formData.append('reason',reason);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/adjustment/information/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("click","#editchartshow", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#group_id').val(data[0]);
        $('#group_name').val(data[2]);
        $("#account_action_edit").modal('show');
    });
    
    
    $("#account_action_edit_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#group_id").val();
        var name=$("#group_name").val();
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/group/edit/"+id;
        var formData=new FormData();
        formData.append('id',id);
        formData.append('name',name);
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                window.location=response.url;
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $(document).on("click","#chart_delete", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#e_id').val(data[0]);
        $("#account_action_delete").modal('show');
    });
    
    $("#account_action_delete_submit").submit(function(e){
        e.preventDefault(); 
        var id=$("#e_id").val();
        var formData=new FormData();
        formData.append('id',id);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/account/group/delete/"+id;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'GET',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    console.log(response.url);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    $("#vendor_replace_product_submit").submit(function(e){
        e.preventDefault(); 
        var date=$("#s_date").val();
        var category=$("#purchase_product_category").val();
        var item_code=$("#product_name").val();
        var order_id=$("#order_id").val();
        var quantity=$("#quantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_id',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/vendor/replace/information/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $(document).on("click","#editvendorreplaceshow", function(e){
        e.preventDefault();
        var tr=$(this).closest('tr');
        var data=tr.children("td").map(function(){
            return $(this).text();
        }).get();
        $('#eid').val(data[0]);
        $('#edate').val(data[1]);
    
        var order_id=  $('#eorder_id').val(data[2]).val();
        var order_selectbox_options = '<option selected value="0">'+order_id+'</option>';
        $('#epurchase_order_id').append(order_selectbox_options);
    
        var epurchase_product_category=$('#ecategory').val(data[3]).val();
        var selectbox_options = '<option selected value="0">'+epurchase_product_category+'</option>';
        $('#epurchase_product_category').append(selectbox_options);
       
        var epurchase_product_name= $('#eproduct_name').val(data[4]).val();
        var product_selectbox_options = '<option selected value="0">'+epurchase_product_name+'</option>';
        $('#epurchase_product_name').append(product_selectbox_options);
    
        // $('#equantity').val(data[5]);
    
        $("#edit-vendor-replace").modal('show');
        
     
    });
    
    $("#vendor_replace_product_edit_submit").submit(function(e){
        e.preventDefault(); 
        var eid=$("#eid").val();
        var date=$("#edate").val();
        var category=$("#epurchase_product_category").val();
        var item_code=$("#eproduct_name").val();
        var order_id=$("#epurchase_order_id").val();
        var quantity=$("#equantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_id',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/vendor/replace/information/submit/"+eid;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                
                    $('#image-uperror').append( '<div  class="animated fadeInDown" style="display: block;">'+response.error+'</div>');
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#customer_replace_product_edit_submit").submit(function(e){
        e.preventDefault();
        var eid=$("#eid").val();
        var date=$("#edate").val();
        var category=$("#epurchase_product_category").val();
        var item_code=$("#eproduct_name").val();
        var order_id=$("#epurchase_order_id").val();
        var quantity=$("#equantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_code',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/customer/replace/information/submit/"+eid;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                
                    $('#image-uperror').append( '<div  class="animated fadeInDown" style="display: block;">'+response.error+'</div>');
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#customer_replace_information_submit").submit(function(e){
        e.preventDefault(); 
        var date=$("#s_date").val();
        var category=$("#purchase_product_category").val();
        var item_code=$("#product_name").val();
        var order_id=$("#order_id").val();
        var quantity=$("#quantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_id',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/customer/replace/information/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    
    
    
    $("#customer_return_information_submit").submit(function(e){
        e.preventDefault(); 
        var date=$("#s_date").val();
        var category=$("#purchase_product_category").val();
        var item_code=$("#product_name").val();
        var order_id=$("#order_id").val();
        var quantity=$("#quantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_id',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/customer/return/information/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#customer_return_product_edit_submit").submit(function(e){
        e.preventDefault();
        var eid=$("#eid").val();
        var date=$("#edate").val();
        var category=$("#epurchase_product_category").val();
        var item_code=$("#eproduct_name").val();
        var order_id=$("#epurchase_order_id").val();
        var quantity=$("#equantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_code',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/customer/return/information/submit/"+eid;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                
                    $('#image-uperror').append( '<div  class="animated fadeInDown" style="display: block;">'+response.error+'</div>');
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                    // console.log(response.url)
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#vendor_return_product_submit").submit(function(e){
        e.preventDefault(); 
        var date=$("#s_date").val();
        var category=$("#purchase_product_category").val();
        var item_code=$("#product_name").val();
        var order_id=$("#order_id").val();
        var quantity=$("#quantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_id',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/vendor/return/information/submit";                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                    
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    $("#vendor_return_product_edit_submit").submit(function(e){
        e.preventDefault(); 
        var eid=$("#eid").val();
        var date=$("#edate").val();
        var category=$("#epurchase_product_category").val();
        var item_code=$("#eproduct_name").val();
        var order_id=$("#epurchase_order_id").val();
        var quantity=$("#equantity").val();
        var formData=new FormData();
        formData.append('date',date);
        formData.append('category',category);
        formData.append('order_id',order_id);
        formData.append('item_code',item_code);
        formData.append('quantity',quantity);
        
        var get_protocol=location.protocol;
        var get_host=location.host;
        var get_location=get_protocol+"//"+get_host+"/admin/welcome/vendor/return/information/submit/"+eid;                                                      
        $.ajax({
            url:get_location,
            dataType : 'json',
            method:'POST',
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                if(response.val_error=="ok")
                {
                
                    $('#image-uperror').append( '<div  class="animated fadeInDown" style="display: block;">'+response.error+'</div>');
                }
                else if(response.success=="ok")
                {
                    window.location=response.url;
                }
            },
            error:function(error){
                console.log(error);
            }
        });
      
    });
    
    });