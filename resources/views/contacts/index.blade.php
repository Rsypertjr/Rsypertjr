<!-- resources/views/contacts/index.blade.php -->
  
    
   
@extends('layouts.app')

@section('content')
    <!-- Bootstrap Boilerplate... -->
    <!-- Create Contact Form...     --->
    
    <div class="panel-body" style="position:relative;left:10em">
        <!-- Display Validation Errors -->
        @include('common.errors')
        
        <!-- New Contact Form -->
        <form id="contactForm" style="position:relative;float:left;width:100em;margin:1em 0" action="{{url('contact') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group" style="position:relative;width:80%;padding:0 0 0 0;margin:0">
				<!-- Contact Name -->
				<div class="form-group" style="position:relative;float:left;width:100%;margin:0 0 0 0">
					<div class="col-sm-6" style="position:relative:float:left;width:30em;margin:0 0 0 10.8em">
					    <div style="position:absolute;top:0.3em;left:-6.7em;font-size:1.5em;top:0em;margin 0 0 0 0em">Enter Contact</div>
						<input style="position:relative;width:75%" type="text" name="firstname" id="firstname" class="form-control" value="Enter First Name">
					</div>
					<div class="col-sm-6" style="position:relative;float:left;width:30em;margin:0 0 0 -8em">
						<input style="position:relative;width:75%" type="text" name="lastname" id="lastname" class="form-control" value="Enter Last Name">
					</div>
					<div class="col-sm-offset-3 col-sm-6" style="position:relative;float:left;width:15em;margin:0 0 0 -7.5em">
						<button id="enterDetails" type="submit" class="btn btn-primary">
							<i style="position:relative;margin-right:0.5em"  class="fa fa-plus"></i> Enter Details
						</button>
					</div>
				</div>
				
			</div>
        </form>  
		
		
		
		
		<form id="searchForm" style="position:relative;float:left;width:100em" action="{{ url('contact/search') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group" style="position:relative;width:80%;padding:0 0 0 0">
			
				<!-- Contact Name -->
				<div class="form-group" style="position:relative;float:left;width:120%;margin:0 0 0 0">					
					
					<div class="col-sm-6" style="position:relative:float:left;width:19em;margin:0 0 0 10.8em">
						<div style="position:absolute;top:0.3em;left:-3em;font-size:1.5em;top:0em;margin 0 0 0 0em">Search</div>
						<input style="position:relative;width:75%;left:1em" type="text" name="searchType" id="searchType" class="form-control btn-info btn-large" value="Click for Search Type">
							</input>
					</div>
					
					<div class="col-sm-6" style="position:relative:float:left;width:40em;margin:0 0 0 -5em">
						<input style="position:relative;width:75%;left:1em" type="text" name="searchItem" id="searchItem" class="form-control" value="Type In Search Item">
					</div>
					
					<div class="col-sm-6" style="position:relative;float:left;width:20em;margin:0 0 0 -9.5em">
						<input style="position:relative;width:75%" type="text" name="searchOrder" id="searchOrder" class="form-control btn-info btn-large" value="Click for Sort Type">
							</input>
					</div>
			        <input type="hidden" id="searchKind" name="searchKind" value="none">
					<input type="hidden" id="sortKind" name="sortKind" value="none">
					<div class="col-sm-offset-3 col-sm-6" style="position:relative;width:15em;margin:0 0 0 -5em">
							<button id="enterDetails" type="submit" class="btn btn-primary">
								<i style="position:relative;margin-right:0.5em"  class="glyphicon glyphicon-refresh"></i>Submit Search
							</button>
					</div>
		        </div>
				
			</div>
        </form>  
		
		
          <!-- Modal will be triggered by Add Contact and Edit Buttons -->
                
			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog"style="position:relative;width:70%;height:auto;margin-left:5em" >
			  <div class="modal-dialog" ></div>
			
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Contact Details</h4>
				  </div>
				  <div id="modalBody" class="modal-body" style="position:relative;width:100%;padding:2em 1em 2em 1em;margin:0">
					   
				  <!-- Contact Detail Entry -->
					<div id="contactDetailContainer">
					  <div class="form-group" style="position:relative;width:100%;padding:0.0;margin:0 0 0 6em;margin:1em 0 1em 6em">
						  <div class="form-group entryInput" style="position:relative;float:left;width:80%;padding:0em;margin:0 0 0 4em;display:block">
								
								
								<div class="col-sm-6"  style="position:relative;float:left;width:40%;padding:0em;margin:1em 0 0 0;height:2em">
									<div id="fnLabel" style="position:absolute;top:0.3em;left:-4em">First Name</div>
									<input type="text" name="firstname2" id="firstname2" value="" class="form-control" style="position:relative;float:left;height:100%;margin:0 0 0 3em">
								</div>
								<div class="col-sm-6"  style="position:relative;float:right;width:40%;padding:0.0;margin:1em 0 0 1.5em;height:2em">
									<div id="lnLabel" style="position:absolute;top:0.3em;left:-4em">Last Name</div>
									<input type="text" name="lastname2" id="lastname2" value="" class="form-control" style="position:absolute;height:100%;margin:0 0 0 3em">
								</div>
								<div class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0.0;margin:1em 0 0 0;height:2em">
									<div id="emLabel" style="position:absolute;top:0.3em;left:-4em">Email</div>
									<input type="text" name="email" id="email" value="" class="form-control" style="position:relative;height:100%;margin:0 0 0 3em">
								</div>
								<div class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0.0;margin:1em 0 0 0;height:2em">
									<div id="phoneLabel" style="position:absolute;top:0.3em;left:-4em">Phone</div>
									<input type="text" name="phone" id="phone" value="" class="form-control" style="position:relative;height:100%;margin:0 0 0 3em">
								</div>
								
								<div id="exDet1" class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0;margin-top:1.5em;height:2.5em;display:none">
									<div id="exdLabel1" style="position:absolute;float:left;height:100%;width:20em;left:-4em;margin:0.4em 0 0 0">Extra Detail 1</div>  
								    <input type="text" name="extraDetail1" id="extraDetail1" value="" class="form-control extraDetail" style="position:relative;float:left;height:100%;width:70%;left:5.4%;margin:0">
									<a href="#" id="exDetButton1" class="btn btn-danger btn-large exDetButton" style="position:relative;float:left;height:100%;width:22%;margin:0 0 0 8%"><i style="position:relative;margin:0 1em 1em 0" class="glyphicon glyphicon-remove-circle"></i>Remove Detail</a>
								</div>
								<div id="exDet2" class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0;margin-top:1.5em;height:2.5em;display:none">
									<div id="exdLabel2" style="position:absolute;float:left;height:100%;width:20em;left:-4em;margin:0.4em 0 0 0">Extra Detail 2</div>  
								    <input type="text" name="extraDetail2" id="extraDetail2" value="" class="form-control extraDetail" style="position:relative;float:left;height:100%;width:70%;left:5.4%;margin:0">
									<a href="#" id="exDetButton2" class="btn btn-danger btn-large exDetButton" style="position:relative;float:left;height:100%;width:22%;margin:0 0 0 8%"><i style="position:relative;margin:0 1em 1em 0" class="glyphicon glyphicon-remove-circle"></i>Remove Detail</a>
								</div>
								<div id="exDet3" class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0;margin-top:1.5em;height:2.5em;display:none">
									<div id="exdLabel3" style="position:absolute;float:left;height:100%;width:20em;left:-4em;margin:0.4em 0 0 0">Extra Detail 3</div>  
								    <input type="text" name="extraDetail3" id="extraDetail3" value="" class="form-control extraDetail" style="position:relative;float:left;height:100%;width:70%;left:5.4%;margin:0">
									<a href="#" id="exDetButton3" class="btn btn-danger btn-large exDetButton" style="position:relative;float:left;height:100%;width:22%;margin:0 0 0 8%"><i style="position:relative;margin:0 1em 1em 0" class="glyphicon glyphicon-remove-circle"></i>Remove Detail</a>
								</div>
								<div id="exDet4" class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0;margin-top:1.5em;height:2.5em;display:none">
									<div id="exdLabel4" style="position:absolute;float:left;height:100%;width:20em;left:-4em;margin:0.4em 0 0 0">Extra Detail 4</div>  
								    <input type="text" name="extraDetai14" id="extraDetail4" value="" class="form-control extraDetail" style="position:relative;float:left;height:100%;width:70%;left:5.4%;margin:0">
									<a href="#" id="exDetButton4" class="btn btn-danger btn-large exDetButton" style="position:relative;float:left;height:100%;width:22%;margin:0 0 0 8%"><i style="position:relative;margin:0 1em 1em 0" class="glyphicon glyphicon-remove-circle"></i>Remove Detail</a>
								</div>
								<div id="exDet5" class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0;margin-top:1.5em;height:2.5em;display:none">
									<div id="exdLabel5" style="position:absolute;float:left;height:100%;width:20em;left:-4em;margin:0.4em 0 0 0">Extra Detail 5</div>  
								    <input type="text" name="extraDetail5" id="extraDetail5" value="" class="form-control extraDetail" style="position:relative;float:left;height:100%;width:70%;left:5.4%;margin:0">
									<a href="#" id="exDetButton5" class="btn btn-danger btn-large exDetButton" style="position:relative;float:left;height:100%;width:22%;margin:0 0 0 8%"><i style="position:relative;margin:0 1em 1em 0" class="glyphicon glyphicon-remove-circle"></i>Remove Detail</a>
								</div>    
								<div id="noExDet" class="col-sm-6"  style="position:relative;float:left;width:100%;padding:0.0;margin:1em 0 0 0;height:2em;display:none">
									<input type="text" name="noExtraDetails" id="noExtraDetails" value="" class="form-control" style="position:relative;height:100;margin:0 0 0 3em">
								</div>
						  </div> 
						  <div class="form-group addButton" style="position:relative;float:left;width:25%;padding:0.0;margin:0.0;height:2em;display:none">
								<input type="hidden" id="whichForm" value="none">
								<input type="hidden" value="hello" id="myField">
								<div class="col-sm-offset-3 col-sm-6 detail-submit" style="position:relative;margin:0 0 0 2em;padding:0.0;height:100%;width:100%">
										<button id="myFormSubmit" type="button" style="position:relative;margin:0.0;padding:0 1em 0 1em;height:100%;width:90%">
											<i class="fa fa-plus" style="position:relative;margin:0 0.5em 0 0;padding:0"></i>Add Name
										</button>
								</div>   
						  </div>
					  </div>
						 
				  </div>
				  <div class="modal-footer" id="modalFooter" >
				    <button type="button" id="adminMode" class="btn btn-default" data-dismiss="modal"  style="position:relative;float:left;width:25%;padding:0.0;margin: 3em 0 0 20%;height:2em;display:block">Administrator</button>
				  	<button type="button" id="addADetail" class="btn btn-success" data-dismiss="modal"  style="position:relative;float:left;width:25%;padding:0.0;margin: 3em 0 0 20%;height:2em;display:none">
						<i style="position:relative;margin-right:0.5em" class="glyphicon glyphicon-plus"></i>Add A Detail</button>
					<button type="submit" id="submitContact" data-dismiss="modal" style="position:relative;float:left;width:25%;padding:0.2em 0 0.4em 0;margin: 3em 0 0 5%;height:2em" class="btn btn-primary btn-large">
						<i class="glyphicon glyphicon-refresh" style="position:relative;margin:0.2em 0.5em 0em 0"></i>Submit Contact
					</button>
				  </div>
			   </div>
			
			</div>
		 </div>
		 
										
										
										
				
				
            </div>
										              
										
										
										

		
    </div>
	
   <div style="position:relative;display:none">{{ $searchType = $type	}}</div>
   @if($type != null)
		<div style="position:relative;display:none">{{ $searchType =  $type }}</div>
   @else
		<div style="position:relative;display:none">{{$searchType = "firstname" }}</div>
   @endif  
   
   </div>
    <!-- Current Tasks -->
   @if(count($contacts) > 0)   
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Contacts
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Contact</th>
                        <th>&nbsp</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <!-- Contact Name -->
                                <td class="table-text">
									@if($searchType == 'lastname')
										<div>{{ $contact->lastname }}</div> 
								    @elseif($searchType == 'email')
										<div>{{ $contact->email }}</div> 
									@elseif($searchType == 'phone')
										<div>{{ $contact->phone }}</div> 
									@else
										<div>{{ $contact->firstname }}</div> 
									@endif
								
                                </td>

                                <td>
                                    <div id="formsDiv">
										<!-- Delete Button -->
										<form action="{{ url('contact/'.$contact->id) }}" method="POST" style="position:relative">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											
											<button type="submit" id="delete-contact-{{$contact->id }}" class="btn btn-danger" style="position:relative;float:left">
												<i class="fa fa-btn fa-trash"></i>Delete
											</button>
										</form>
										<form id="editForm{{ $contact->id }}" class="editForm" action="{{ url('contact/'.$contact->id.'/edit') }}"  method="POST" style="position:relative">
											{!! csrf_field() !!}
											{!! csrf_field() !!}
												<button href="#" type="submit" id="editContact" class="btn btn-success" style="position:relative;float:left;margin:0 0 0 1em"><span id="editSpan" class="glyphicon glyphicon-fast-backward"></span> Edit</button>
												<input type="hidden" name="firstname" id="firstname" value="{{ $contact->firstname }}">
												<input type="hidden" name="lastname" id="lastname" value="{{ $contact->lastname }}">
												<input type="hidden" name="email"  id="email" value="{{ $contact->email }}">
												<input type="hidden" name="phone" id="phone" value="{{ $contact->phone }}">
												<input type="hidden" name="extraDetail1"  id="extraDetail1" class="extraDetail" value="{{ $contact->extraDetail1 }}">
												<input type="hidden" name="extraDetail2"  id="extraDetail2" class="extraDetail"  value="{{ $contact->extraDetail2 }}">
												<input type="hidden" name="extraDetail3"  id="extraDetail3"  class="extraDetail" value="{{ $contact->extraDetail3 }}">
												<input type="hidden" name="extraDetail4" id="extraDetail4" class="extraDetail"  value="{{ $contact->extraDetail4 }}">
												<input type="hidden" name="extraDetail5"  id="extraDetail5" class="extraDetail"  value="{{ $contact->extraDetail5 }}">
												<input type="hidden" name="noExtraDetails" id="noExtraDetails" value="{{ $contact->noExtraDetails }}">
												<input type="hidden" name="contactId" id="contactId" value="{{ $contact->id }}">
										</form>
									</div>
									
									
                                </td>
                            </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>
        
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

    @endif 
@endsection