<div id="remove-section-{{$count+1}}">
<div class="form-group col-md-3">
    <select id="inputState" name="filter[advance_search][]" class="form-control advance_search">
         @includeif('crm.accounts._common_field_list_filter');
    </select>
</div>
<div class="form-group col-md-3">
   <select id="inputState" class="form-control advance_operator" name="filter[advance_operator][]">
        <option value="">None...</option>
        <option value="=">Equal</option>
        <option value="!=">Not Equal To</option>
        <option value="start_with">Start With</option>
        <option value="end_with">End With</option>
        <option value="contains">Contains</option>
        <option value="does_not_contains">Does Not Contains</option>
    </select>
 </div>
 
 <div class="form-group col-md-2">
   <input type="text" name="filter[search_text][]" placeholder="Enter" class="form-control search_text">
 </div>
 <div class="form-group col-md-2">
    <select id="inputState" id="condition" class="form-control condition" name="filter[condition][]">
        <option value="">Select Condition</option>
        <option value="AND">AND</option>
        <option value="OR">OR</option>
    </select>
 </div>
 <div class="form-group col-md-2" id="{{$count+1}}">
    <a href="javascript:void(0);" data-target="#remove-section-{{$count+1}}" data-request="remove"><i class="fa fa-trash" ></i></a>
 </div>
</div>