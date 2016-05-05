<!-- JavaScript  -->
     <script type="text/javascript">
     
     
       function entryDetail(detailName)
            {
             
            // Detail Name for database column use    
            var dcolName = detailName.replace(/\s+/g, '').toLocaleLowerCase(); 
            
            var entryDet =
            '<div class="form-group" style="position:relative;width:80%;padding:0.0;margin:1em 0 1em 6em">\
                    <div class="form-group entryInput" style="position:relative;float:left;width:55%;padding:0;margin:0 0 0 4em;display:None">\
                            <div class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0.0;margin:0.0;height:2em">\
                                <input type="text" name="'+dcolName+'" id="'+dcolName+'" value="'+detailName+'" class="form-control" style="position:relative;height:100%">\
                            </div>\
                    </div>\
                    <div class="form-group addButton" style="position:relative;float:left;width:25%;padding:0.0;margin:0.0;height:2em">\
                            <input type="hidden" value="hello" id="myField">\
                            <div class="col-sm-offset-3 col-sm-6 detail-submit" style="position:relative;margin:0 0 0 2em;padding:0.0;height:100%;width:100%">\
                                    <button id="myFormSubmit" type="button" style="position:relative;margin:0.0;padding:0 1em 0 1em;height:100%;width:90%">\
                                        <i class="fa fa-plus" style="position:relative;margin:0 0.5em 0 0;padding:0"></i>Add '+detailName+'\
                                    </button>\
                            </div>\
                    </div>\
                </div>';
              //alert(entryDet);
              return  entryDet;          
            }
  
            var nameDetail = '<div class="form-group" style="position:relative;width:80%;padding:0.0;margin:0 0 0 6em;margin:1em 0 1em 6em">\
                                <div class="form-group entryInput" style="position:relative;float:left;width:80%;padding:0em;margin:0 0 0 4em;display:none">\
                                  <div class="col-sm-6"  style="position:relative;float:left;width:40%;padding:0em;margin:0 0 0 0;height:2em">\
                                     <input type="text" name="firstname" id="first-name" value="First Name" class="form-control" style="position:relative;height:100%">\
                                  </div>\
                                  <div class="col-sm-6"  style="position:relative;float:right;width:40%;padding:0.0;margin:0 0 0 1.5em;height:2em">\
                                     <input type="text" name="lastname" id="last-name" value="Last Name" class="form-control" style="position:relative;height:100%">\
                                  </div>\
                                 </div>\
                                 <div class="form-group addButton" style="position:relative;float:left;width:25%;padding:0.0;margin:0.0;height:2em">\
                                   <input type="hidden" value="hello" id="myField">\
                                 <div class="col-sm-offset-3 col-sm-6 detail-submit" style="position:relative;margin:0 0 0 2em;padding:0.0;height:100%;width:100%">\
                                    <button id="myFormSubmit" type="button" style="position:relative;margin:0.0;padding:0 1em 0 1em;height:100%;width:90%">\
                                        <i class="fa fa-plus" style="position:relative;margin:0 0.5em 0 0;padding:0"></i>Add Name\
                                    </button>\
                                 </div>\
                             </div>';
  
            $(document).ready(function(){
				
                $('#contactForm').on('submit',function(e){
					    
					   e.preventDefault();
                       //Show Modal and adjust Add Button
                       $('#myModal').modal('show'); 
                       $('.addButton').width('48%').css('margin-left','20%');
                       
                        
                       // Bring up Detail Entry Field   
                       $('.addButton').on('mousedown',function(){
                            
                            $(this).css('display','none');
                            $(this).parent().find('.entryInput').css('display','block').width('75%').css('margin','0em 0em 0em 10%');
                        });
                        
                        
                        // Disable Enter Key on Form
                        $('#myModal').on('keydown',function(e){
                           if(e.which == 13)  //Disable Enter key
                                    e.preventDefault();
                         });
                       
                       
                        // Erase input values on initial focus
                        $('#myModal input').on('focus', function(e){
                                $(this).val('');
                         });
					    
						return false;
                  });  
                
                  //Show Modal with Required Fields
                  $('#myModal').on('show.bs.modal', function() {
                         // if (!data) return e.preventDefault() // stops modal from being shown
                      
                     
                           $("#submitDetails").on('mousedown',function(){
                                    $('#contactForm').submit();
                                  });
                          
                        });
  
            }); // End of (document).ready    
     
     </script> 