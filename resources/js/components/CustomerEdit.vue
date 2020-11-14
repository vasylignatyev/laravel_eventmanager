<template>
    <form action="/customer/{{$customer->id}}" enctype="multipart/form-data" method="POST" >
        @csrf
        @method("PATCH")

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{__('Email')}}</label>
            <div class="col-md-6">
                <input
                    id="email"
                    type="email"
                    class="form-control{{$errors->has('email')}}"
                    name="email"
                    value="{{$customer->email}}"
                    placeholder="{{__('email')}}"
                    autocomplete="email" autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{__('First name')}}</label>
            <div class="col-md-6">
                <input
                    id="first_name"
                    type="text"
                    class="form-control{{$errors->has('first_name')}}"
                    name="first_name"
                    value="{{$customer->first_name}}"
                    placeholder="{{__('first name')}}"
                    autocomplete="first_name" autofocus>
                @if ($errors->has('first_name'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="second_name" class="col-md-4 col-form-label text-md-right">{{__('Second name')}}</label>
            <div class="col-md-6">
                <input
                    id="second_name"
                    type="text"
                    class="form-control{{$errors->has('second_name')}}"
                    name="second_name"
                    value="{{$customer->second_name}}"
                    placeholder="{{__('second name')}}"
                    autocomplete="second_name" autofocus>
                @if ($errors->has('second_name'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('second_name') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{__('Last name')}}</label>
            <div class="col-md-6">
                <input
                    id="last_name"
                    type="text"
                    class="form-control{{$errors->has('last_name')}}"
                    name="last_name"
                    value="{{$customer->last_name}}"
                    placeholder="{{__('last name')}}"
                    autocomplete="last_name" autofocus>
                @if ($errors->has('last_name'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="sex" class="col-md-4 col-form-label text-md-right">{{__('Sex')}}</label>
            <div class="col-md-6">
                <select
                    id="sex"
                    name="sex"
                    class="form-control"
                >
                    <option>M</option>
                    <option>F</option>
                </select>
                @if ($errors->has('sex'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sex') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                <a href="/customer/{{$customer->id}}" class="btn btn-primary">{{__('Cancel')}}</a>
            </div>
        </div>
    </form>
</template>

<script>
export default {
name: "CustomerEdit"
}
</script>

<style scoped>

</style>
