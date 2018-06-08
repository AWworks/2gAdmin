@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('foodItem.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>
<!--Edit blade-->
@if(Session::has('foodItem_err'))
<p class="alert alert-danger" id="editResponse">{{ Session::get('foodItem_err') }}</p>
@endif
        <form class="uk-form uk-form-horizontal forms" id="forms" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>FoodItem Name</label>
            <input class="form-control" type="text" name="foodItemName" value="<?php echo $foodItem['foodItem'][0]['foodItemName'] ?>" required="" autofocus="">
        </div>

        <div class="form-group">
            <label>Description</label>
            <input class="form-control" type="text" name="foodItemDescription" value="<?php echo $foodItem['foodItem'][0]['foodItemDescription'] ?>" required="">
        </div>

        <div class="form-group">
            <label>FoodItem Name In Arabic</label>
            <input class="form-control arabic" type="text" value="<?php echo $foodItem['foodItem'][0]['foodItemNameInArabic'] ?>" name="foodItemNameInArabic"/>
        </div>

        <div class="form-group">
            <label>FoodItem Description In Arabic</label>
            <input class="form-control arabic" type="text" value="<?php echo $foodItem['foodItem'][0]['foodItemDescriptionInArabic'] ?>" name="foodItemDescriptionInArabic"/>
        </div>

        <div class="form-group">
            <label>Image input</label>
            <input type="file" class="form-control-file" id="image" name="foodItemImage">
        </div>
        <div class="form-group">
                <label>Poster Image input</label>
                <input type="file" class="form-control-file" id="poster_image" name="foodItemPosterImage" >
            </div>
        <div class="form-group">
            <label>AddOn</label>
            <div class="clear"></div>
                <ul class="uk-list uk-list-striped">
                    @foreach($addOnCategory as $onCategory)
                        <li>
                            <div class="uk-grid">
                                <div class="uk-width-1-3">
                                    {{$onCategory->addOnCatName}}
                                </div>
                            </div>
                        </li>

                        <ul class="uk-list uk-list-striped">
                            @foreach($addOnItem as $onItem)
                                @foreach($onItem->category as $catId)
                                    @if($catId->id == $onCategory->id)
                                        <li><input value="{{ $onItem->id }}" type="checkbox"
                                                   name="addOnItem[]"
                                                <?php foreach ($foodItem['AddOnItem'] as $val) {
    if ($val->addOnItem_id == $onItem->id) {
        echo "checked";
    }
}
?>/>
                                                {{$onItem->addOnItemName}}
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    @endforeach
                </ul>
        </div>

        <div class="form-group">
            <label class="uk-form-label uk-h3">Food Category</label>
                <div class="clear"></div>
                @if ($foodCategory->count())
                    <ul class="uk-list uk-list-striped">
                        @foreach($foodCategory as $category)
                            <li><input class="icheck" name="foodCategory[]" type="checkbox"
                                       value="{{ $category->id }}"
                <?php foreach ($foodItem['FoodCategory'] as $val) {
    if ($val->id == $category->id) {
        echo "checked";}
}?>> {{ $category->foodCatName }}

                            </li>
                        @endforeach
                    </ul>
                @endif
        </div>

        <div class="form-group">
            <label class="uk-form-label uk-h3">Size</label>
                <table id="editTable">
                    <tbody id="files-root">
            <?php
$count_tr = 1;
foreach ($foodItem['sizes'] as $val) {
    ?>
                    <tr id="<?php echo $count_tr; ?>">
                        <td><select id="units" name="size[]" style="width:100px;margin-top:1px;">
                                @if ($sizes->count())
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}"
                             <?php if ($val->size_id == $size->id) {
        echo "selected";}?>>{{$size->sizeName}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td><input type="text" name="price[]" value="<?php echo $val->price; ?>" style="width:100px;">
                        <span style="color: red;padding-left: 7px;cursor: pointer; vertical-align:middle;font-size:14px;" onclick="removerTrData(<?php echo $count_tr; ?>)">Remove</span></td>

                    </tr>
                    <?php }?>
                    </tbody>
                </table>
                <div onclick="addFile()" style="cursor:pointer;color:#333333;font-size:18px;font-weight:bold;float:right;margin-right:397px;margin-top: -54px;
                width:40px;border-radius:46px;border:#dfdfdf 1px solid;padding: 9px;height: 41px;">
                    <i class="fa fa-plus" style="font-size:25px;"></i></div>
            </div>

        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="foodItemStatus">
                    <option value="Active" <?php if ($foodItem['foodItem'][0]['foodItemStatus'] == 'Active') {echo "selected";}?>>Active</option>
                    <option value="InActive"  <?php if ($foodItem['foodItem'][0]['foodItemStatus'] == 'InActive') {echo "selected";}?>>InActive</option>
            </select>
        </div>

        <div class="form-group">
            <label></label>
            <input type="submit" value="Update foodItem"
                   class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
    <style>
.arabic {
    direction: rtl;
}
</style>
    <script type="text/javascript">
        var gFiles = 0;
        function addFile() {
            var tr = document.createElement('tr');
            tr.setAttribute('id', 'file-' + gFiles);


            var td13 = document.createElement('td');
            td13.innerHTML = '<td><select id="units" name="size[]" style="width:100px;margin-top:1px;"><?php foreach ($sizes as $size) {?><option value="<?php echo $size->id; ?>"><?php echo $size->sizeName; ?></option><?php }?></select>  </td> ';
            tr.appendChild(td13);
            var td3 = document.createElement('td');
            td3.innerHTML = '<td><input type="text" name="price[]" style="width:100px;"> &nbsp;&nbsp;<span onclick = "removeFile(\'file-' + gFiles + '\')" style = "cursor:pointer;color:#ff0000;vertical-align:middle;font-size:14px;">Remove</span></td>';
            tr.appendChild(td3);
            document.getElementById('files-root').appendChild(tr);
            gFiles++;
            dehydrated();
        }
        function removeFile(aId) {
            var obj = document.getElementById(aId);
            obj.parentNode.removeChild(obj);
        }
        function removerTrData(id){
            $('table#editTable tr#'+id).remove();
        }
        $('#editResponse').delay(5000).fadeOut('slow');
    </script>
@endsection
