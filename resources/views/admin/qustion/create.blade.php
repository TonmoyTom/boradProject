@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
      Subject
    </div>
<div class="card-body">
    <div class="form-group">

        <div class="row justify-content-center">
            <div class="col-lg-10 col-sm-6 col-md-6">
                <div class="well well-sm">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <form action="{{route('qustions.store')}}" method="POST"  >
                @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Board Or Subject</label>
                    <select class="custom-select" id="inputGroupSelect01" name="bd_id"  >
                        <option style="color: #000;" >Choose...</option>
                        @foreach ($boards as $item)
                        <option style="color: #000;" value="{{$item->id}}">{{$item->name}} - {{$item->subjects->name}} - {{$item->year}}</option>
                        @endforeach
                    </select>
                </div>
                    <div x-data="question">
                        <div class="form-group row ">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="col-lg-6" >

                                    <div class="allQuestion" style="padding: 10px 20px; border-radius: 10px;
                                     margin-bottom: 30px;box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);" >
                                        <div class="form-group row align-items-center">
                                            <div class="col-md-12">
                                                <label><span x-text="index+1"></span>.Question Name</label>
                                                <input type="text" name="business_category[]" class="form-control"
                                                       placeholder="Enter Question Name" />
                                                <div class="d-md-none mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left:30px">
                                            <div class="col-md-8">
                                                <div class="answer_name">
                                                    <label>Answer</label>
                                                    <input type="text" name="image[]" class="form-control"
                                                           placeholder="Enter full name" />
                                                </div>
                                                <div class="answer_name">

                                                    <input type="text" name="image[]" class="form-control"
                                                           placeholder="Enter full name" />
                                                </div>
                                                <div class="answer_name">

                                                    <input type="text" name="image[]" class="form-control"
                                                           placeholder="Enter full name" />
                                                </div>
                                                <div class="answer_name">

                                                    <input type="text" name="image[]" class="form-control"
                                                           placeholder="Enter full name" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="answer">
                                                    <label>Right</label>
                                                    <input type="radio" name="image[]"
                                                           placeholder="Enter full name"  style="margin-top: 12px; width: 30px; height: 20px;"/>
                                                </div>
                                                <div class="answer">

                                                    <input type="radio" name="image[]"
                                                           placeholder="Enter full name"  style="margin-top: 22px; width: 30px; height: 20px;"/>
                                                </div>
                                                <div class="answer">
                                                    <input type="radio" name="image[]"
                                                           placeholder="Enter full name"  style="margin-top: 22px; width: 30px; height: 20px;"/>
                                                </div>
                                                <div class="answer">

                                                    <input type="radio" name="image[]"
                                                           placeholder="Enter full name"  style="margin-top: 20px; width: 30px; height: 20px;"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center" >
                                            <div class="answer_button" style="margin: 10px 0px ">
                                                <button type="button"  @click="addItem()"
                                                        class="btn btn-primary" style="border-radius: 10px;margin-left: 10px;">
                                                    <i class="la la-plus"></i>Add
                                                </button>
                                                <button type='button' style="border-radius: 10px;margin-left: 10px;"
                                                        class="btn btn-danger"
                                                        @click="removeItem(index)">
                                                    <i class="la la-trash-o"></i>Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>


                        </div>
                    </div>

                </form>
                </div>

            </div>

        </div>
    </div>
    </div>
</div>
@endsection

@push('script')
<script>
 function question(){
    return {

        items: [{
            'business_category': '',
            'image': '',
            'counter' : 1


        }],
        addItem() {
            if (this.items.length === 40) return;
                this.items.push({
                    'business_category': '',
                    'image': '',

                })


        },
        removeItem(index) {
            if (this.items.length === 1) return;
            this.items.splice(index, 1);
        },

    }

 }
</script>
@endpush


