<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

////////////////////////////COMPANY_LISTS////////////////////////////////////////////

Route::prefix('companies')->group(function () {
    Route::get('/', [CoopCompanyController::class, 'index'])->name('companies.index');
    Route::post('/', [CoopCompanyController::class, 'store'])->name('companies.store');
});

Route::prefix('deleted_companies')->group(function () {
    Route::get('/', [DeletedCompanyController::class, 'index'])->name('deleted_companies');
    Route::post('/update/{company}', [DeletedCompanyController::class, 'update'])->name('deleted_companies.update');
});

///////////////////////////////OSGB_EMPLOYEES/////////////////////////////////////////

Route::prefix('change_validate')->group(function () {
    Route::get('/', [ChangeValidateController::class, 'index'])->name('change_validate');
    Route::post('/delete/{demand}', [ChangeValidateController::class, 'delete'])->name('change_validate.delete');
    Route::post('/update/{demand}', [ChangeValidateController::class, 'update'])->name('change_validate.update');
});

Route::prefix('osgb_employees')->group(function () {
    Route::get('/', [OsgbEmployeeController::class, 'index'])->name('osgb_employees');
    Route::post('/create', [OsgbEmployeeController::class, 'create'])->name('osgb_employees.create');
    Route::post('/update', [OsgbEmployeeController::class, 'handle'])->name('osgb_employees.handle');
});

Route::prefix('deleted_employees')->group(function () {
    Route::get('/', [DeletedEmployeeController::class, 'index'])->name('deleted_employees');
    Route::post('/', [DeletedEmployeeController::class, 'handle'])->name('deleted_employees.handle');
});

/////////////////////////////////AUTHENTICATION///////////////////////////////////////

Route::prefix('authentication')->group(function () {
    Route::get('/', [EmployeeAuthenticateController::class, 'index'])->name('authentication');
    Route::post('/update/{user}', [EmployeeAuthenticateController::class, 'employeeAuthenticate'])->name('authentication.employeeAuthenticate');
});

////////////////////////////////COOP_COMPANY////////////////////////////////////////

Route::prefix('/company')->group(function () {
    Route::prefix('/{id}')->group(function () {

        Route::get('/', [CompanyController::class, 'index'])->name('company');

        ///////////////////////////////INFORMATIONS////////////////////////////////////////////

        Route::get('/informations', [CompanyController::class, 'showInfo'])->name('company.informations.index');
        Route::get('/informations/osgb', [CompanyController::class, 'showInfo'])->name('company.informations.osgb');
        Route::get('/informations/formal', [CompanyController::class, 'showInfo'])->name('company.informations.formal');
        Route::get('/informations/acc', [CompanyController::class, 'showInfo'])->name('company.informations.acc');
        Route::get('/informations/group', [CompanyController::class, 'showInfo'])->name('company.informations.group');

        ///////////////////////////////EMPLOYEES////////////////////////////////////////////

        Route::get('/employees', [CompanyController::class, 'showEmployees'])->name('company.employees');
        Route::get('/employees/deleted', [CompanyController::class, 'showEmployees'])->name('company.employees.deleted');
        Route::get('/employees/with-missing-documents', [CompanyController::class, 'showEmployees'])->name('company.employees.withMissingDocuments');

        /////////////////////////////DOCUMENTS//////////////////////////////////////////////

        Route::get('/documents', [CompanyController::class, 'showDocuments'])->name('company.documents');
        Route::get('/documents/mandatory-files', [CompanyController::class, 'showDocuments'])->name('company.documents.mandatoryFiles');
        Route::get('/documents/notebook-copies', [CompanyController::class, 'showDocuments'])->name('company.documents.notebookCopies');
        Route::get('/documents/observation-reports', [CompanyController::class, 'showDocuments'])->name('company.documents.observationReports');

        /////////////////////////////EMPLOYEE GROUPS//////////////////////////////////////////////
        Route::get('/employee-groups', [CompanyController::class, 'showEmployeeGroups'])->name('company.employee-groups');
        Route::get('/employee-groups/isg-duties', [CompanyController::class, 'showEmployeeGroups'])->name('company.employee-groups.isg-duties');
        Route::get('/employee-groups/emergency-group', [CompanyController::class, 'showEmployeeGroups'])->name('company.employee-groups.emergency-group');
        Route::get('/employee-groups/risk-group', [CompanyController::class, 'showEmployeeGroups'])->name('company.employee-groups.risk-group');
    });
    Route::get('/deleted/{id}', [CompanyController::class, 'deletedIndex'])->name('deleted_company');
    Route::post('/delete/{company}', [CompanyController::class, 'delete'])->name('company.delete');
    Route::post('/update/{company}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('/{company}/assignEmployee', [CompanyController::class, 'assignEmployee'])->name('company.assignEmployee');
    Route::post('/{company}/addEmployee', [CompanyController::class, 'addEmployee'])->name('company.addEmployee');
    Route::post('/{company}/deleteEmployee/{employee}', [CompanyController::class, 'deleteEmployee'])->name('company.deleteEmployee');
    Route::post('/{company}/add-accountant', [CompanyController::class, 'addAcc'])->name('company.add-accountant');
    Route::post('/{company}/upload-accountant', [CompanyController::class, 'uploadAcc'])->name('company.upload-accountant');
    Route::post('/{company}/change-group-informations', [CompanyController::class, 'changeGroup'])->name('company.change-group-informations');
});

Route::prefix('employee')->group(function () {
    Route::get('/{employee}', [CoopEmployeeController::class, 'index'])->name('coop_employee');
    Route::get('/deleted/{employeeId}', [CoopEmployeeController::class, 'deletedIndex'])->name('deleted.coop_employee');
    Route::post('/update/{employee}', [CoopEmployeeController::class, 'update'])->name('coop_employee.update');
    Route::post('/delete/{employee}', [CoopEmployeeController::class, 'delete'])->name('coop_employee.delete');
    Route::post('/restore/{id}', [CoopEmployeeController::class, 'restore'])->name('coop_employee.restore');
});

////////////////////////////////////////////////////////////////////////

Route::get('/settings', function () {
    return view('admin/settings');
})->name('settings');

///////////////////////////////COMPANY_ADMIN/////////////////////////////////////////
Route::post('assign-company-admin/{company}', [AssignCompanyAdminController::class, 'assign'])->name('assign-company-admin');
Route::get('assigned-company-admins', [AssignCompanyAdminController::class, 'index'])->name('assigned-company-admins');
Route::delete('/delete-company-admin/{user}', [AssignCompanyAdminController::class, 'delete'])->name('delete-company-admin');
Route::delete('/delete-company-admin-relation/{relation}', [AssignCompanyAdminController::class, 'deleteRelation'])->name('delete-company-admin-relation');
Route::post('/get-all-company-admins', [AssignCompanyAdminController::class, 'getAllCompanyAdmins'])->name('get-all-company-admins');
