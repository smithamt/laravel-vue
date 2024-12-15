@extends('layouts.workspace')

@section('title')
Home
@endsection

@section('content')
<h1>Dashboard</h1>
<div class="flex gap-4 p-4 flex-wrap">
    <div class="card" style="width: 18rem;">
        <img src="https://blog.usetada.com/hs-fs/hubfs/Mengenal%20Employee%20Perks%20dan%20Benefitnya%20untuk%20Karyawan.jpg?width=2501&name=Mengenal%20Employee%20Perks%20dan%20Benefitnya%20untuk%20Karyawan.jpg" class="card-img-top" alt="...">
        <div class="card-body space-y-4">
            <h5 class="card-title font-bold text-lg">Total Employees {{ $employeeCount }}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="/employees/create" class="btn btn-primary">Create New Employee</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img src="https://www.slideteam.net/media/catalog/product/cache/1280x720/c/o/company_management_hierarchy_managers_executives_employee_Slide01.jpg" class="card-img-top" alt="...">
        <div class="card-body space-y-4">
            <h5 class="card-title font-bold text-lg">Total Position {{ $positionCount }}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img src="https://www.siteminder.com/wp-content/uploads/2024/03/Hotel-departments.png" class="card-img-top" alt="...">
        <div class="card-body space-y-4">
            <h5 class="card-title font-bold text-lg">Total Department {{ $departmentCount }}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
</div>
@endsection