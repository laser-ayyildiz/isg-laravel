<?php

namespace App\Http\Controllers\CompanyAdmin;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/company-admin/companies');

Route::get('/companies', [CoopCompanyController::class, 'index'])->name('companies');

Route::get('/company/{id}', [CompanyController::class, 'index'])->name('company');

Route::prefix('employee')->group(function () {
    Route::get('/{employee}/company/{company}', [CoopEmployeeController::class, 'index'])->name('employee');
    Route::get('/deleted/{employee}/company/{company}', [CoopEmployeeController::class, 'deletedIndex'])->name('deleted-employee');
});

Route::prefix('/company')->group(function () {
    Route::prefix('/{id}')->group(function () {

        Route::get('/', [CompanyController::class, 'index'])->name('company');

        ///////////////////////////////INFORMATIONS////////////////////////////////////////////

        Route::get('/informations', [CompanyController::class, 'showInfo'])->name('company.informations.index');
        Route::get('/informations/osgb', [CompanyController::class, 'showInfo'])->name('company.informations.osgb');
        Route::get('/informations/formal', [CompanyController::class, 'showInfo'])->name('company.informations.formal');
        Route::get('/informations/acc', [CompanyController::class, 'showInfo'])->name('company.informations.acc');

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
});
