<div class="tab-pane fade" id="link3" role="tabpanel" aria-labelledby="link3-tab">
    <fieldset id="field3">
        <div class="modal-body">
            <h3 style="text-align: center;"><u><b>İsg Uzmanı Seç</b></u></h3>
            <div class="row">
                <div class="col-sm-4">
                    <label for="uzman_id">
                        <h6><b>1. İsg Uzmanı<a style="color:red">*</a></b></h6>
                    </label>
                    <select class="form-control" name="uzman_id" id="uzman_id" autocomplete="off" size="1" required>
                        @if (old('uzman_id'))
                        <option value="{{ old('uzman_id') }}" selected>{{ old('uzman_id') }}
                        </option>
                        @else
                        <option value="" disabled selected><b>1. İsg Uzmanı</b></option>
                        @endif
                        @foreach ($osgbEmployees as $employee )
                        @if (in_array($employee->job_id,[1,2,3]))
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="uzman_id_2">
                        <h6><b>2. İsg Uzmanı</b></h6>
                    </label>
                    <select class="form-control" name="uzman_id_2" id="uzman_id_2" autocomplete="off" size="1">
                        @if (old('uzman_id_2'))
                        <option value="{{ old('uzman_id_2') }}" selected>{{ old('uzman_id_2') }}
                        </option>
                        @else
                        <option value="" disabled selected><b>2. İsg Uzmanı</b></option>
                        @endif
                        @foreach ($osgbEmployees as $employee )
                        @if (in_array($employee->job_id,[1,2,3]))
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach

                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="uzman_id_3">
                        <h6><b>3. İsg Uzmanı</b></h6>
                    </label>
                    <select class="form-control" name="uzman_id_3" id="uzman_id_3" autocomplete="off" size="1">
                        @if (old('uzman_id_3'))
                        <option value="{{ old('uzman_id_3') }}" selected>{{ old('uzman_id_3') }}
                        </option>
                        @else
                        <option value="" disabled selected><b>3. İsg Uzmanı</b></option>
                        @endif
                        @foreach ($osgbEmployees as $employee )
                        @if (in_array($employee->job_id,[1,2,3]))
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach

                    </select>
                </div>
            </div>
            <hr style="border-top: 1px dashed red;">

            <h3 style="text-align: center;"><u><b>İş Yeri Hekimi Seç</b></u></h3>
            <div class="row">
                <div class="col-sm-4">
                    <label for="hekim_id">
                        <h6><strong>1.İş Yeri Hekimi<a style="color:red">*</a></strong></h6>
                    </label>
                    <select class="form-control" name="hekim_id" id="hekim_id" autocomplete="off" size="1" required>
                        @if (old('hekim_id'))
                        <option value="{{ old('hekim_id') }}" selected>{{ old('hekim_id') }}
                        </option>
                        @else
                        <option value="" disabled selected>İş Yeri Hekimi</option>
                        @endif
                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 4)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach

                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="hekim_id_2">
                        <h6><strong>2.İş Yeri Hekimi</strong></h6>
                    </label>
                    <select class="form-control" name="hekim_id_2" id="hekim_id_2" autocomplete="off" size="1">
                        @if (old('hekim_id_2'))
                        <option value="{{ old('hekim_id_2') }}" selected>{{ old('hekim_id_2') }}
                        </option>
                        @else
                        <option value="" disabled selected>İş Yeri Hekimi</option>
                        @endif

                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 4)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="hekim_id_3">
                        <h6><strong>3.İş Yeri Hekimi</strong></h6>
                    </label>
                    <select class="form-control" name="hekim_id_3" id="hekim_id_3" autocomplete="off" size="1">
                        @if (old('hekim_id_3'))
                        <option value="{{ old('hekim_id_3') }}" selected>{{ old('hekim_id_3') }}
                        </option>
                        @else
                        <option value="" disabled selected>İş Yeri Hekimi</option>
                        @endif
                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 4)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <hr style="border-top: 1px dashed red;">

            <h3 style="text-align: center;"><u><b>Personel Seç</b></u></h3>
            <div class="row">
                <div class="col-sm-4">
                    <label for="saglık_p_id"><strong>Diğer Sağlık Personeli</strong></label>
                    <select class="form-control" name="saglık_p_id" id="saglık_p_id" autocomplete="off" size="1">
                        @if (old('saglık_p_id'))
                        <option value="{{ old('saglık_p_id') }}" selected>{{ old('saglık_p_id') }}
                        </option>
                        @else
                        <option value="" disabled selected>Diğer Sağlık Personeli</option>
                        @endif

                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 5)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="ofis_p_id"><strong>Ofis Personeli</strong></label>
                    <select class="form-control" name="ofis_p_id" id="ofis_p_id" autocomplete="off" size="1">
                        @if (old('ofis_p_id'))
                        <option value="{{ old('ofis_p_id') }}" selected>{{ old('ofis_p_id') }}
                        </option>
                        @else
                        <option value="" disabled selected>Ofis Personeli</option>
                        @endif

                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 6)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach

                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="muhasebe_p_id"><strong>Muhasebe Personeli</strong></label>
                    <select class="form-control" name="muhasebe_p_id" id="muhasebe_p_id" autocomplete="off" size="1">
                        @if (old('muhasebe_p_id'))
                        <option value="{{ old('muhasebe_p_id') }}" selected>
                            {{ old('muhasebe_p_id') }}</option>
                        @else
                        <option value="" disabled selected>Muhasebe Personeli</option>
                        @endif

                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 7))
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach

                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="saglık_p_id_2"><strong>2.Diğer Sağlık Personeli</strong></label>
                    <select class="form-control" name="saglık_p_id_2" id="saglık_p_id_2" autocomplete="off" size="1">
                        @if (old('saglık_p_id_2'))
                        <option value="{{ old('saglık_p_id_2') }}" selected>
                            {{ old('saglık_p_id_2') }}</option>
                        @else
                        <option value="" disabled selected>2.Diğer Sağlık Personeli</option>
                        @endif

                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 5)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach

                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="ofis_p_id_2"><strong>2.Ofis Personeli</strong></label>
                    <select class="form-control" name="ofis_p_id_2" id="ofis_p_id_2" autocomplete="off" size="1">
                        @if (old('ofis_p_id_2'))
                        <option value="{{ old('ofis_p_id_2') }}" selected>{{ old('ofis_p_id_2') }}
                        </option>
                        @else
                        <option value="" disabled selected>2.Ofis Personeli</option>
                        @endif

                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 6)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="muhasebe_p_id_2"><strong>2.Muhasebe Personeli</strong></label>
                    <select class="form-control" name="muhasebe_p_id_2" id="muhasebe_p_id_2" autocomplete="off"
                        size="1">
                        @if (old('muhasebe_p_id_2'))
                        <option value="{{ old('muhasebe_p_id_2') }}" selected>
                            {{ old('muhasebe_p_id_2') }}</option>
                        @else
                        <option value="" disabled selected>2.Muhasebe Personeli</option>
                        @endif

                        @foreach ($osgbEmployees as $employee )
                        @if ($employee->job_id == 7)
                        <option value="{{ $employee -> id }}"><b>{{ $employee -> name }}</b>
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="float-left">Lütfen (*) bulunan alanları doldurmayı unutmayınız</div>
            <button type="button" class="btn btn-primary next" id="next3" name="next">Devam Et</button>
        </div>
    </fieldset>

</div>