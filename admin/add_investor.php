
<style type="text/css">
    .form-style-2{
        max-width: 500px;
        padding: 20px 12px 10px 20px;
        font: 13px Arial, Helvetica, sans-serif;
    }
    .form-style-2-heading{
        font-weight: bold;
        font-style: italic;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        font-size: 15px;
        padding-bottom: 3px;
    }
    .form-style-2 label{
        display: block;
        margin: 0px 0px 15px 0px;
    }
    .form-style-2 label > span{
        width: 100px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 5px;
    }
    .form-style-2 span.required{
        color:red;
    }
    .form-style-2 .tel-number-field{
        width: 40px;
        text-align: center;
    }
    .form-style-2 input.input-field{
        width: 55%;

    }

    .form-style-2 input.input-field,
    .form-style-2 .tel-number-field,
    .form-style-2 .textarea-field,
    .form-style-2 .select-field{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border: 1px solid #C2C2C2;
        box-shadow: 1px 1px 4px #EBEBEB;
        -moz-box-shadow: 1px 1px 4px #EBEBEB;
        -webkit-box-shadow: 1px 1px 4px #EBEBEB;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        padding: 7px;
        outline: none;
    }
    .form-style-2 .input-field:focus,
    .form-style-2 .tel-number-field:focus,
    .form-style-2 .textarea-field:focus,
    .form-style-2 .select-field:focus{
        border: 1px solid #0C0;
    }
    .form-style-2 .textarea-field{
        height:100px;
        width: 55%;
    }
    .form-style-2 input[type=submit],
    .form-style-2 input[type=button]{
        border: none;
        padding: 8px 15px 8px 15px;
        /*background: #FF8500;*/
        color: #fff;
        box-shadow: 1px 1px 4px #DADADA;
        -moz-box-shadow: 1px 1px 4px #DADADA;
        -webkit-box-shadow: 1px 1px 4px #DADADA;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
    }
    .form-style-2 input[type=submit]:hover,
    .form-style-2 input[type=button]:hover{
        background: #EA7B00;
        color: #fff;
    }
</style>
<!--<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>-->
<!--<script type="text/javascript">-->
<!--    tinymce.init({-->
<!--        selector: "textarea"-->
<!--    });-->
<!--</script>-->
<!--<div class="content-block"></div>-->
<div class="form-style-2-heading">Provide your information</div>

    <?php
    if (isset($message))
        echo '<span style="color: rgb(255, 79, 3);font-size: 16px;">' . $message . '</span>';?>
    <div class="form-style-2">

        <form action="admin/processblogpost.php" method="post"novalidate enctype="multipart/form-data" >
            <label for="field1"><span>Name <span class="required">*</span></span><input type="text" class="input-field" name="name" value="" placeholder="Company Name" /></label>
            <label for="field2"><span>Email <span class="required">*</span></span><input type="text" class="input-field" name="email" value=""placeholder="Email" /></label>
            <label for="field1"><span>Phone <span class="required">*</span></span><input type="text" class="input-field" name="phone" value="" placeholder="Phone"/></label>
            <label for="field1"><span>Location <span class="required">*</span></span><input type="text" class="input-field" name="location" value="" placeholder="location"/></label>
            <label for="field1"><span>Partners <span class="required">*</span></span><input type="text" class="input-field" name="partners" value=""placeholder="Partners(john doe,Ram)" /></label>
            <label for="field5"><span>About <span class="required">*</span></span><textarea name="about" id="description" class="textarea-field" placeholder="About"></textarea></label>
<!--            <div class="form-item"><label>Avatar</label><input type="file" accept="image/*" name="thumbnailImg"  id="thumbnailImg" placeholder="Input an image file for thumbnail"></div></br>-->
            <label for="field3"><span>Avatar</span></span><input type="file" accept="image/*" name="thumbnailImg"  id="thumbnailImg" placeholder="Input an image file for thumbnail"/></label>
            <div class=""id="image_preview"><img id="previewing" src="uploads/avatars/nophoto.jpg" /></div>
            <label><span>&nbsp;</span><input type="submit"  value="Submit" class="upload-next" name="add_investors"/></label>

        </form>
    </div>
<script type="text/javascript">
    // for just displaying uploading images
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewing').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#thumbnailImg").change(function(){
        readURL(this);
    });
 </script>

