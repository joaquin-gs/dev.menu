@extends('adminlte::page')

@push('js')
<script type="text/javascript" src="{{asset('/js/jqWidgets/jqx-all.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/utils.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/patient.js')}}"></script>
@endpush

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.base.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.energyblue.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jqWidgets/jqx.darkblue.css') }}">
<style>
   .toast { opacity: 1 !important; }

   .grid-btn { margin: 3px 0px 0px 5px; }

   input:valid {
      background-color: #fff;
      border: 1px solid #ced4da;
   }

   input:required { border: 1px solid black; }

   input:invalid { background-color: #ffdddd; }

   .content .container { max-width: 98%; }

   #leftPanel { 
      border-right: 1px solid #e9ecef; 
      padding-right: 0px;
   }

   #rightPanel { margin-left: 15px; }

   .breadcrumb { 
      padding: 7px!important;
      width: 98%!important; 
   }

   .switchBtn { margin-left: 4px; }
   .switchBtn .jqx-switchbutton-thumb { background-color: red; }

   #toolbargrid, #pagergrid { background-color: skyblue; }

   #toolbargrid div h4 { margin-left: 10px; margin-top: 3px; }

   .tabContainer { padding: 0 15px 0 15px; }

   .hidden { display: none; }
</style>
@endpush

@section('content')
<div class="container">
   <div class="justify-content-center">
      <div id="grid"></div>

      <div id="dataForm" class="hidden">
         <form id="patientForm" method="POST" action="/patient/store" class="container">
            {{ csrf_field() }}
            <div id="tabs">
               <ul>
                  <li><strong>General information</strong></li>
                  <li><strong>Registry information</strong></li>
               </ul>

               <div class="tabContainer">
                  <div class="row" style="margin-top: 5px;">
                     <div id="leftPanel" class="col">
                        <div class="row justify-content-center breadcrumb"><span>General patient information</span></div>
                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Family name</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm" name="familyNameEn" id="familyNameEn" maxlength="45" required /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>First name</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm" name="firstNameEn" id="firstNameEn" maxlength="45" required /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label" title="Khmer family name"><label>នាមត្រកូល</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm khmer" name="familyNameKh" id="familyNameKh" maxlength="45" required /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label" title="Khmer first name"><label>នាមខ្លួន</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm khmer" name="firstNameKh" id="firstNameKh" maxlength="45" required /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Gender</label></div>
                           <div name="gender" id="sex" title="Click to change"></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Date of birth</label></div>
                           <div class="col"><input type="date" class="form-control-sm" name="dob" id="dob" maxlength="10" /></div>
                           <div class="col">
                              <input type="checkbox" class="form-check-input col-1" id="estimatedDoB" name="estimatedDoB"/>&nbsp;
                              <label class="form-check-label" for="estimatedDoB" style="padding-top: 3px;"> Date of birth is estimated</label>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label" title="Caretaker name"><label>អ្នកថែរក្សា</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm khmer" name="caretakerNameKh" id="caretakerNameKh" maxlength="45" required /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Relationship</label></div>
                           <div class="col-6">
                              <select id="relationship" name="relationship" class="form-control-sm">
                                 <option value="Mother" selected="">Mother</option>
                                 <option value="Father">Father</option>
                                 <option value="Grandmother">Grandmother</option>
                                 <option value="Aunt">Aunt</option>
                                 <option value="Neighbor">Neighbor</option>
                                 <option value="Sister">Sister</option>
                                 <option value="Friend">Friend</option>
                                 <option value="Uncle">Uncle</option>
                                 <option value="Grandfather">Grandfather</option>
                                 <option value="Brother">Brother</option>
                                 <option value="Sister in-law">Sister in-law</option>
                                 <option value="Brother in-law">Brother in-law</option>
                                 <option value="Wife">Wife</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Distance</label></div>
                           <div class="col-6">
                              <select id="distance" name="distance" class="form-control-sm">
                                 <option value=">60 Km" selected="">&gt;60 Km</option>
                                 <option value="20-40 Km">20-40 Km</option>
                                 <option value="05-10 Km">05-10 Km</option>
                                 <option value="10-20 Km">10-20 Km</option>
                                 <option value="02-05 Km">02-05 Km</option>
                                 <option value="40-60 Km">40-60 Km</option>
                                 <option value="<02 Km">&lt;02 Km</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Nationality</label></div>
                           <div class="col-6">
                              <select id="nationality" name="nationality" class="form-control-sm" style="width: 362px;">
                              @foreach ($nationalities as $country)
                              <option value="{{ $country['alpha2Code'] }}">{{ $country['name'] }}</option>
                              @endforeach
                              </select>
                           </div>
                        </div>

                        <div class="row justify-content-center breadcrumb"><span>Geographic information</span></div>
                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Province</label></div>
                           <div class="col-6">
                              <select id="provinceID" name="provinceID" class="form-control-sm">
                              @foreach ($provinces as $province)
                              <option value="{{ $province->provinceID }}">{{ $province->provinceNameEn }}</option>
                              @endforeach
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>District</label></div>
                           <div class="col-6">
                              <select id="districtID" name="districtID" class="form-control-sm">
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Commune</label></div>
                           <div class="col-6">
                              <select id="communeID" name="communeID" class="form-control-sm">
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Village</label></div>
                           <div class="col-6">
                              <select id="villageID" name="villageID" class="form-control-sm">
                              </select>
                           </div>
                        </div>
                     </div>

                     <div id="rightPanel" class="col">
                        <div class="row justify-content-center breadcrumb"><span>Patient category</span></div>
                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Is it a tourist?</label></div>
                           <div id="isForeigner" name="isForeigner" class="switchBtn" title="Click to change"></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Is AHC employee?</label></div>
                           <div id="isEmployee" name="isEmployee" class="switchBtn" title="Click to change"></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Employee ID</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm" name="employeeCardId" id="employeeCardId" maxlength="10" disabled /></div>
                        </div>
                        <div class="form-row row">
                           <div class="col-5 col-sm-5 col-form-label"><label>Employee card expiry date</label></div>
                           <div class="col-6"><input type="date" class="form-control-sm" name="employeeCardExpiry" id="employeeCardExpiry" maxlength="10" disabled /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Patient has poor ID?</label></div>
                           <div id="hasPoorId" name="hasPoorId" class="switchBtn" title="Click to change"></div>
                        </div>
                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Poor ID expiry date</label></div>
                           <div class="col-6"><input type="date" class="form-control-sm" name="poorIdExpiry" id="poorIdExpiry" maxlength="10" disabled /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Patient has HEF?</label></div>
                           <div id="hasHEF" name="hasHEF" class="switchBtn" title="Click to change"></div>
                        </div>
                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>HEF expiry date</label></div>
                           <div class="col-6"><input type="date" class="form-control-sm" name="HEFexpiry" id="HEFexpiry" maxlength="10" disabled /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Has third party payer?</label></div>
                           <div id="thirdPartyPayer" name="thirdPartyPayer" class="switchBtn" title="Click to change"></div>
                        </div>
                        <div class="form-row row">
                           <div class="col-5 col-sm-4 col-form-label"><label>Insurance company name</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm" name="insuranceName" id="insuranceName" maxlength="10" disabled /></div>
                        </div>

                        <div class="row justify-content-center breadcrumb"><span>Address and contact</span></div>
                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Address</label></div>
                           <div class="col-6"><textarea class="form-control" rows="3" id="address" name="address"></textarea></div>
                        </div>
                        <br/>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Phone number</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm" name="phone1" id="phone1" maxlength="15" /></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Additional phone number</label></div>
                           <div class="col-6"><input type="text" class="form-control-sm" name="phone2" id="phone2" maxlength="15" /></div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="tabContainer">
                  <br/>
                  <div class="row" style="margin-top: 5px;">
                     <div class="col" style="border-right: 1px solid #e9ecef; ">
                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Operational district</label></div>
                           <div class="col">
                              <select id="operational_district" name="operational_district" class="form-control-sm">
                                 <option value="0">Select one</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Is for follow up?</label></div>
                           <div id="followup" name="followup" class="switchBtn" title="Click to change"></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Referred from</label></div>
                           <div class="col">
                              <select id="referred_from_code" name="referred_from_code" class="form-control-sm">
                                 <option value="0">Select one</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Is it a priority?</label></div>
                           <div id="priority" class="switchBtn" title="Click to change"></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Gate time</label></div>
                           <div id="gate_time"></div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Quick nurse time</label></div>
                           <div id="quick_nurse_time"></div>
                        </div>
                     </div>

                     <div class="col" style="margin-left: 15px;">
                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>To unit</label></div>
                           <div class="col">
                              <select id="to_unit_code" name="to_unit_code" class="form-control-sm">
                                 <option value="0">Select one</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-row row">
                           <div class="col-3 col-form-label"><label>Outpatient service</label></div>
                           <div class="col">
                              <select id="outpatient_service_code" name="outpatient_service_code" class="form-control-sm">
                                 <option value="0">Select one</option>
                              </select>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="comment" class="col-form-label label-color">Note</label>
                                 <div class="form-group">
                                    <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>                        
                     </div>
                  </div>
               </div>
            </div>

            <br/>
            <div class="row justify-content-center">
               <input type="submit" value="Submit" id="submitBtn" class="btn btn-sm btn-default btn-primary col-1" />
               <span class="spacer col-1">&nbsp;</span>
               <input type="button" value="Cancel" id="cancelBtn" class="btn btn-sm btn-default btn-primary col-1" />
            </div>
         </form>
      </div>

   </div>
</div>
@if($errors->any())
<div class="form-row row justify-content-center">
   <div class="alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
</div>
@endif
@endsection
