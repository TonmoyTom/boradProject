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
                    <label for="recipient-name" class="col-form-label" style="color: #000;">SubJects</label>
                    <select class="custom-select" id="inputGroupSelect01" name="sub_id"  >
                        <option style="color: #000;" >Choose...</option>
                        @foreach ($subject as $item)
                        <option style="color: #000;" value="{{$item->id}}">{{$item->slug}}..</option>
                        @endforeach
                    </select>


                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Board</label>
                    <select class="custom-select" id="inputGroupSelect01" name="bd_id"  >
                        <option style="color: #000;" >Choose...</option>
                        @foreach ($boards as $item)
                        <option style="color: #000;" value="{{$item->id}}">{{$item->slug}}..</option>
                        @endforeach
                    </select>


                </div>

                <div class="form-group" >
                    <label for="recipient-name" class="col-form-label" style="color: #000;">Name</label><br>
                    <input type="text" class="form-control" name="name" style="color: #000; margin-bottom: 15px;"/>
              </div>
                <div x-data="dataItems">
                    <div class="form-group  text-center">
                      <span class="col-lg-8 col-form-label h3 text-center mb-3">Answer</span>
                    </div>
                    <div class="form-group text-center">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="col-lg-12">
                              <div class="form-group row align-items-center">
                                <div class="col-md-2">
                                  <label>Options</label>
                                  <input type="text" name="names[]" class="form-control" placeholder="Enter full name" />
                                  <div class="d-md-none mb-2"></div>
                                </div>
                                <div class="col-md-2">
                                  <label>Right Answer</label>
                                  <div class=" col-md-9">
                                    <input type="hidden" value="0" :name=`point[${index}]` />
                                    <span class="switch switch-icon">
                                      <label>
                                        <input type="checkbox" value="1" :name=`point[${index}]` />
                                        <span></span>
                                      </label>
                                    </span>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <button type='button' class="btn btn-sm font-weight-bolder btn-light-danger"
                                    @click="removeItem(index)">
                                    <i class="la la-trash-o"></i>Delete
                                  </button>
                                </div>
                              </div>
                            </div>
                          </template>

                    </div>
                    <div class="form-group row">
                      <div class="col-lg-4">
                        <button type="button" @click="addItem()" class="btn btn-sm font-weight-bolder btn-light-primary">
                          <i class="la la-plus"></i>Add
                        </button>
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" >Submit</button>
                        <a class="btn btn-info" href="{{ route('admin.home') }}">
                           Back
                        </a>
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
  let avatar5 = new KTImageInput('logo');
        let avatar6 = new KTImageInput('footerLogo');
</script>
<script defer src="https://unpkg.com/alpinejs@3.5.0/dist/cdn.min.js"></script>
<script>
  document.addEventListener('alpine:init', () => {
             Alpine.data('dataItems', () => ({
                 items: [{
                     'options': '',
                     'point': '',

                 }],

                 addItem() {
                   if(this.items.length > 3) return;

                     this.items.push({
                       'options': '',
                       'point': '',
                     })
                 },

                 removeItem(index) {
                     if (this.items.length === 1) return;
                     this.items.splice(index, 1);
                 },
             }))
         })
</script>
@endpush


