<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

	<!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
	
	<!-- JavaScript  -->
     <script type="text/javascript">
     
     
       function entryDetail(detailName)
            {
            var entryDet =
            '<div class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0.0;margin:1em 0 0 0;height:2em;display:block">\
			<div id="exdLabel5" style="position:absolute;top:0.3em;left:-4em">Extra Detail</div>\
			<input type="text" name="'+detailName+'" id="'+detailName+'" value="Add Extra Detail Here" class="form-control" style="position:relative;height:100%;margin:0 0 0 3em">\
			</div>';
              //alert(entryDet);
              return  entryDet;          
            }
  
            var nameDetail = '<div class="form-group" style="position:relative;width:80%;padding:0.0;margin:0 0 0 6em;margin:1em 0 1em 6em">\
                                <div class="form-group entryInput" style="position:relative;float:left;width:80%;padding:0em;margin:0 0 0 4em;display:block">\
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
				
				
				
				//CONTACT FORM
                $('#contactForm').on('submit',function(e){
					 
					   e.preventDefault();
                       //Show Modal and adjust Add Button
                       $('#myModal').modal('show'); 
					   
										   
					   //Set which form is showing Modal
					   var whichForm = $('#myModal').find('#whichForm');
					   whichForm.val('contact');
					   
                       $('.addButton').width('48%').css('margin-left','20%');
                       
                        
                   /*    // Bring up Detail Entry Field   
                       $('.addButton').on('mousedown',function(){
                            
                            $(this).css('display','none');
                            $(this).parent().find('.entryInput').css('display','block').width('75%').css('margin','0em 0em 0em 10%');
                        });  */
                        
                        
                        // Disable Enter Key on Form
                        $('#myModal').on('keydown',function(e){
                           if(e.which == 13)  //Disable Enter key
                                    e.preventDefault();
                         });
                       
                       
                        // Erase input values on initial focus
                        $('#myModal input').on('focus', function(e){
                                $(this).val('');
                         });
					    $(this).unbind('submit');

                  });  
				  
				    //Show Modal with Required Fields
					$('#enterDetails').on('mousedown',function(){
					  $('#myModal').on('show.bs.modal', function() {
						 // if (!data) return e.preventDefault() // stops modal from being shown						 
							
							 var fn = $('#contactForm').find('#firstname').val();
							 var ln = $('#contactForm').find('#lastname').val();
							//insert first and last name values
							$(this).find('#firstname2').val(fn);
							$(this).find('#lastname2').val(ln);
													 
						});		

						 $('#myModal').on('hide.bs.modal', function() {		
							// Values input into modal form
							var email = $(this).find('#email').val();
							var phone = $(this).find('#phone').val();
							var exDet1 = '';
							var exDet2 = '';
							var exDet3 = '';
							var exDet4 = '';
							var exDet5 = '';
							var noExDets = 0;
							
							

						   $('#contactForm').append('<input type="hidden" name="email" value="'+email+'">')
											.append('<input type="hidden" name="phone" value="'+phone+'">')
											.append('<input type="hidden" name="extraDetail1" value="'+exDet1+'">')
											.append('<input type="hidden" name="extraDetail2" value="'+exDet2+'">')
											.append('<input type="hidden" name="extraDetail3" value="'+exDet3+'">')
											.append('<input type="hidden" name="extraDetail4" value="'+exDet4+'">')
											.append('<input type="hidden" name="extraDetail5" value="'+exDet5+'">')
											.append('<input type="hidden" name="noExtraDetails" value="'+noExDets+'">');  
					   
						   $('#contactForm').unbind('submit').submit();
					
						 });	
							
							
					
							
					});
				  
				  	//CONTACT FORM DISPLAY
					$('.exDetButton').css('display','none');
					$('#adminMode').on('mousedown',function(){
						$(this).css('display','none');
						$('#addADetail').css('display','block');
						$('.exDetButton').css('display','block');
					});                  

					// Disable Enter Key on Contact Form
					$('#contactForm').on('keydown',function(e){
					   if(e.which == 13)  //Disable Enter key
								e.preventDefault();
					 });
				   
				   
					// Erase input values on initial focus on Contact Form
					$('#contactForm input').on('focus', function(e){
							$(this).val('');
					 });
					
					$('.exDetButton').on('mousedown',function(){
						$(this).parent().css('display','none');
						$(this).parent().find('.extraDetail').val('');
					});
					
				/*	$('#contactForm #firstname').on('blur', function(e){
								$(this).val('Enter First Name');
						 });
					
					$('#contactForm #lastname').on('blur', function(e){
								$(this).val('Enter Last Name');
						 });
				*/
				  
				  
				  
					
				//EDIT FORM	
			   $('.editForm').on('submit',function(e){
				 
					e.preventDefault();
				   //Show Modal and adjust Add Button
				   $('#myModal').modal('show'); 
				   $('.addButton').width('48%').css('margin-left','20%');
				   
				   //Set which form is showing Modal
				   var whichForm = $('#myModal').find('#whichForm');
				   whichForm.val('edit');
				   
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
				   
					$(this).unbind('submit');
						  
				   });   
				
				
				
				$('.editForm').on('mousedown',function(){
						
				      var contactId = $(this).find('#contactId').val();	
					
					  $('#myModal').on('show.bs.modal', function() {
							 // if (!data) return e.preventDefault() // stops modal from being shown		
							var extraDetail = new Array();
							var cfirstname = $('#editForm'+contactId).find('#firstname').val();	
							var clastname = $('#editForm'+contactId).find('#lastname').val();
							var cemail = $('#editForm'+contactId).find('#email').val();
							var cphone = $('#editForm'+contactId).find('#phone').val();
							var noExDets = $('#editForm'+contactId).find('#noExtraDetails').val();
							
							// Prefill Dialog of Contact
							$(this).find('#firstname2').val(cfirstname);
							$(this).find('#lastname2').val(clastname);
							$(this).find('#email').val(cemail);
							$(this).find('#phone').val(cphone);
							
							// Filter number of non Empty extra Details
							$nonEmptyDetails =	$('#editForm'+contactId).find('.extraDetail').filter(function()
							{
								return $(this).val() != '';
								
							});  
							
							var noExDets = $nonEmptyDetails.length;
							var i = 1;
							 $($nonEmptyDetails).each(function(){
								  extraDetail[i] = $(this).val();
								  $('#contactDetailContainer').find('#exDet'+(i)).css('display','block');
								  $('#contactDetailContainer').find('#extraDetail'+(i)).val(extraDetail[i]);
								  i++;
							  });
							
						
							// Add Extra Details to Edit Form
							var noDetails = noExDets;   
							$('#addADetail').on('mousedown',function(){
							
								if(noDetails < 5)
									{
										noDetails++;
										var el = '#exDet'+noDetails;
										$('#contactDetailContainer').find(el).css('display','block');
										
									}				
								else if(noDetails >= 5)
									{
											noDetails++;
											alert('Sorry! Only 5 Extra Details per Contact.');
											
									}
								else;
								
							});
							
												 
						});  
						
						
										
						
							
					  $('#myModal').on('hide.bs.modal', function() {
						  
								// Prefill with original values from form
								var firstname = $(this).find('#firstname2').val();
								var lastname = $(this).find('#lastname2').val();
								var email = $(this).find('#email').val();
								var phone = $(this).find('#phone').val();
								var exDet1 = $(this).find('#extraDetail1').val();
								var exDet2 = $(this).find('#extraDetail2').val();
								var exDet3 = $(this).find('#extraDetail3').val();
								var exDet4 = $(this).find('#extraDetail4').val();
								var exDet5 = $(this).find('#extraDetail5').val();
								
								var noExtraDetails = 0;
								if(exDet1 != '')
									noExtraDetails++;
								if(exDet2 != '')
									noExtraDetails++;
								if(exDet3 != '')
									noExtraDetails++;
								if(exDet4 != '')
									noExtraDetails++;
								if(exDet4 != '')
									noExtraDetails++;
								
																		
								// Reload form with new values
								$('#editForm'+contactId).find('#firstname').val(firstname);
								$('#editForm'+contactId).find('#lastname').val(lastname);
								$('#editForm'+contactId).find('#email').val(email);
								$('#editForm'+contactId).find('#phone').val(phone);
								$('#editForm'+contactId).find('#extraDetail1').val(exDet1);
								$('#editForm'+contactId).find('#extraDetail2').val(exDet2);
								$('#editForm'+contactId).find('#extraDetail3').val(exDet3);
								$('#editForm'+contactId).find('#extraDetail4').val(exDet4);
								$('#editForm'+contactId).find('#extraDetail5').val(exDet5);
								$('#editForm'+contactId).find('#noExtraDetails').val(noExtraDetails);
								
								
								//Submit form
								$('#editForm'+contactId).unbind('submit').submit();
								
						});		
							
							
				
							
				});
				
			
				
				//SEARCH FORM DISPLAY
				// Search Type Selector
				var typeCounter = 0;
				var searchType = '';
				var typeMessage = new Array();
				var sType = new Array();
				typeMessage[0] = 'Email Search';
				sType[0] = "email";
				typeMessage[1] = 'Last Name Search';
				sType[1] = "lastname";
				typeMessage[2] = 'Phone Number Search';
				sType[2] = "phone";
				typeMessage[3] = 'Click for Search Type';
				sType[3] = 'none';
				$('#searchType').on('mousedown',function(){
					$(this).focus();
					$(this).val(typeMessage[typeCounter]).fadeOut(100).fadeIn(100);
					searchType = sType[typeCounter];
					typeCounter++;
					if(typeCounter == 4)
						typeCounter = 0;
					
					//alert(searchType);
					$('#enterDetails').on('mousedown',function(){
						$('#searchType').val('Click for Search Type');
					});
				});
				
				
				
				// Sort Type Selector
				var sortCounter = 0;
				var sortType = '';
				var sortMessage = new Array();
				var stType = new Array();
				sortMessage[0] = 'Ascending Sort';
				stType[0] = 'asc';
				sortMessage[1] = 'Descending Sort';
				stType[1] = 'desc';
				sortMessage[2] = 'Click for Sort Type';
				stType[2] = 'none';
				$('#searchOrder').on('mousedown',function(){
					
						var checkType = $('#searchType').val();
						
						
						if(checkType == 'Click for Search Type'){
							alert("Remember to Select a Search Type");
							sortCounter = 2;
						}
				
					
					$(this).focus();
					$(this).val(sortMessage[sortCounter]).fadeOut(100).fadeIn(100);
					sortType = stType[sortCounter];
					sortCounter++;
					if(sortCounter == 3)
						sortCounter = 0;
					
					$('#enterDetails').on('mousedown',function(){
						$('#searchOrder').val('Click for Sort Type');					
					});
				});
				
				
				
				// Disable Enter Key on Search Form
					$('#searchForm').on('keydown',function(e){
					   if(e.which == 13)  //Disable Enter key
								e.preventDefault();
					 });
				   
				   
					// Erase input values on initial focus
					$('#searchForm input').on('focus', function(e){
							$(this).val('');
					 });
			
			//sortType
			//searchType
			
			// SEARCH FORM
			
				  $('#searchForm').on('submit',function(e){
					  $el = $('<input></input>').attr('type','hidden').attr('name','searchKind').val(searchType);
					  $(this).append($el);
					  
					  $el = $('<input></input>').attr('type','hidden').attr('name','sortKind').val(sortType);
					  $(this).append($el)

                  });  
				
				
		   $('#gitHubLogin').on('mousedown',function(){
		   	
		   	    $el = $('<input></input>').attr('type','hidden').attr('name','whichButton').val('github')
		   	    $('#loginForm').append($el);
		   	
		   		$('#loginForm').submit();
		   });
				
		  		
		   $('#facebookLogin').on('mousedown',function(){
		   	
		   	    
		   	    $el = $('<input></input>').attr('type','hidden').attr('name','whichButton').val('facebook')
		   	    $('#loginForm').append($el);
		   	
		   		$('#loginForm').submit();
		   });
						
				

           }); // End of (document).ready    
     
     </script> 
<style>
	span#editSpan:before {padding-right:1em}
</style>	
</head>
<body id="app-layout">
	
	
<!-- FACEBOOK SDK  ----------------------------------------------------------------------------------------->	
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '586395078198098',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<!------------------------------------------------------------------------------------------------------------>	
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
        	
        
        	
        <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>
		
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                
                
                <ul class="nav navbar-nav navbar-right">
                	<!---Facebook Login -->
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
           
         
        </div>
   
    </nav>

    @yield('content')

  
</body>
</html>
