@extends('errors::illustrated-layout')

@section('title', __('Yasaklanmış'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Yasaklanmış'))
