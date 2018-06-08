@extends('master.masterCreate')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('foodItem.index')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>List</a>
        </div>
        <form class="uk-form uk-form-horizontal forms" id="forms"
              method="POST" action="{{route('foodItem.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label>FoodItem Name</label>
                <input class="form-control" type="text"
                       name="foodItemName" required autofocus/>
            </div>

            <div class="form-group">
                <label>FoodItem Description</label>
                <input class="form-control" type="text"
                       name="foodItemDescription" required/>
            </div>

            <div class="form-group">
                <label>FoodItem Name In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="foodItemNameInArabic"/>
            </div>

            <div class="form-group">
                <label>FoodItem Description In Arabic</label>
                <input class="form-control arabic" type="text"
                       name="foodItemDescriptionInArabic"/>
            </div>

            <div class="form-group">
                <label>Thumbnail Image input</label>
                <input type="file" class="form-control-file" id="image" name="foodItemImage" required>
            </div>

            <div class="form-group">
                <label>Poster Image input</label>
                <input type="file" class="form-control-file" id="poster_image" name="foodItemPosterImage" required>
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
                                                   name="addOnItem[]"/>{{$onItem->addOnItemName}}</li>
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
                                       value="{{ $category->id }}"> {{ $category->foodCatName }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="form-group">
                <label class="uk-form-label uk-h3">Dish</label>
                <div class="clear"></div>
                @if ($dishes->count())
                    <ul class="uk-list uk-list-striped">
                        @foreach($dishes as $dish)

                            <li><input class="icheck" name="dish[]" type="checkbox"
                                       value="{{ $dish->id }}">{{ $dish->dishName }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>


            <div class="form-group">
                <label class="uk-form-label uk-h3">Size</label>
                <table>
                    <tbody id="files-root">
                    <tr>
                        <td><select id="units" name="size[]" style="width:100px;margin-top:1px;">
                                @if ($sizes->count())
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->sizeName}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td><input type="text" name="price[]" style="width:100px;"></td>
                    </tr>
                    </tbody>
                </table>
                <div onclick="addFile()" style="cursor:pointer;color:#333333;font-size:18px;font-weight:bold;float:right;margin-right:397px;margin-top: -54px;
				width:40px;border-radius:46px;border:#dfdfdf 1px solid;padding: 9px;height: 41px;">
                    <i class="fa fa-plus" style="font-size:25px;"></i></div>
            </div>


            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="foodItemStatus">
                    <option value="Active">Active</option>
                    <option value="InActive">InActive</option>
                </select>
            </div>

            <div class="form-group">
                <label></label>
                <input type="submit" value="Add FoodItem"
                       class="btn btn-success">
            </div>

        </form>
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
            td13.innerHTML = '<td><select id="units" name="size[]" style="width:100px;margin-top:1px;"><?php foreach ($sizes as $size){ ?><option value="<?php echo $size->id; ?>"><?php echo $size->sizeName; ?></option><?php } ?></select>  </td> ';
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
    </script>
@endsection