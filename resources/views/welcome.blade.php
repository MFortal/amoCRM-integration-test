@extends('layouts.app')

@section('content')

<div class="relative sm:flex sm:justify-center sm:items-center selection:text-white mx-auto w-75">
    <h2 class="text-center">Тестовое задание для Roistat</h2>

    <form class=" w-px-500 p-3 p-md-3 needs-validation" action="{{ route('form.send') }}" method="post" role="form">
        @csrf
        <div class="body mb-4">
            <div class="card-body">
                <div class="row mb-3 form-group">
                    <label class="col-sm-2 col-form-label">Имя</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Игорь" required>
                    </div>
                </div>
                <div class="row mb-3 form-group">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="test@gmail.com" required>
                    </div>
                </div>

                <div class="row mb-3 form-group">
                    <label class="col-sm-2 col-form-label">Телефон</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" placeholder="+7(999)789-78-89" onkeypress="return isKeyForPhone(event)" required>
                    </div>
                </div>

                <div class="row mb-3 form-group">
                    <label class="col-sm-2 col-form-label">Цена</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="price" placeholder="500" onkeypress="return isNumberKey(event)" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer text-center">
            <button type="reset" class="btn me-5">Очистить</button>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </form>

</div>

<script>
    const isNumberKey = (evt) => {
        const charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    };

    const isKeyForPhone = (evt) => {
        const charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && [32, 40, 41, 43, 45].indexOf(charCode) == -1 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    };
</script>

@endsection