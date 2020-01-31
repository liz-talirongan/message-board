<?php 

    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

    echo $this->Html->css('https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css');


    echo $this->Html->script('https://code.jquery.com/ui/1.10.4/jquery-ui.min.js');



?>


<div class='users' style="width:60%;margin: 0 auto;">
    

    <div id='message'></div>


    <?php 
         echo $this->Form->create('User', array('id'=>'uploadimage','type'=>'file')); 
    ?>

    <div style="width:auto;height:100px;">
          

          <?php if (!($userImage)): ?>
             <img id='previewing' src="<?php echo $this->webroot; ?>img/profile/default.jpg"     style="width:auto;height:150px;float:left;">
          <?php else: ?>

             <img id='previewing' src="<?php echo $this->webroot; ?>img/profile/<?php echo $userImage ?>"     style="width:auto;height:150px;float:left;">

          <?php endif; ?>

           <p style="float:left;">

                    <?php 
                        echo $this->Form->file('imageFile',array(
                            'id' => 'fileImage'
                        )) 
                    ?> 
              

            </p>


    </div>



    
    <div style="clear:both;display:table;"></div>


    <p>

        <?php 

                    echo $this->Form->input('name',array(
                        'id' => 'userName'
                    )); 

                    echo $this->Form->input('email');

                   

                    echo $this->Form->input('gender',array(
                        'type' => 'radio',
                        'style'=>'display:table',
                        'options' => array(
                            '1' => 'Male',
                            '2' => 'Female'
                        )
                    ));
                 

            ?>



    </p>

    <div>

        <label>Birthdate: </label>

        <p style="float:left;">

            <?php echo $this->Form->div('birthdate',array(

                'class' => 'datepicker',
                'type' => 'text',
                'label' => false,
                'div' => false,
                'style'=>'width:200px; height:20px;display:table'

            )) ?>

        </p>

        <!-- <img id="datepicker1" src="<?php echo $this->webroot; ?>img/calendar.png" style="float:left;margin-left:1%;margin-top:2px;display:inline">
 -->
        <div id='aaaa'></div>

    </div>

    <p>

        <?php

               echo $this->Form->input('birthdate1',array(
                        'id' => 'select_date',
                        'type' => 'hidden'
                    ));



                    echo $this->Form->input('hubby');

                    echo $this->Form->submit('Update', array('value'=>'Update', 'class'=>'submit')); 
                    echo $this->Form->end();


         ?>

    </p>











</div>


<script type="text/javascript">

    $(document).ready(function(){


        var oldBirthDate = $('.datepicker').val();

        $('#select_date').val(oldBirthDate);
        $('#datepicker2').val(oldBirthDate);


        $("#datepicker1").click(function(){


        });

        $('.datepicker').datepicker(
        { 
                 dateFormat: 'yy-mm-dd',
                 onSelect: function(dateText, inst) { 
                   
                    $('#select_date').val(dateText);     
                        
                }
        });

   

        $('#userName').change(function(){

             $('#message').empty();
            var characterLength = $(this).val().length;



            if(characterLength <= 0 || characterLength > 20){

                  $('#message').append($('#message').html("<p id='error' style='color:red;text-align:center'>The name must be between 5 and 20 characters</p>"));



            }else{
                $('#message').empty();
                
            }

        });
     

        $('#fileImage').change(function(){


            $('#message').empty();

            var file = this.files[0];

            var imagefile = file.type;

          
            var match = ["image/png","image/jpg","image/jpeg","image/gif"];

    
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
                //console.log("error");
                $('#message').append($('#message').html("<p id='error' style='color:red;text-align:center'>Please Select A valid Image File</p>"+"<h4 style='text-align:center'>Note:Only jpeg, jpg and png Images type allowed</h4>"));
                $('#fileImage').val('');

                return false;
            }else{ 
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }

        });


        function imageIsLoaded(e) {
           $('#previewing').attr('src', e.target.result);
        }

    });


</script