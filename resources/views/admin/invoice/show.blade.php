@extends('admin.layouts.layout')

@section('title')
  {{-- here goes the title of page --}}
  Invoice
@endsection

@section('css')
  
@endsection

@section('body')
  {{-- here goes content of pages --}}


@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif
<div >
  <!-- Main content -->
    <section class="invoice" >
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            
  <img src="{{ asset('/user_styles/images/testlogo.png') }}" /> Master Clinic
            <small class="pull-right">Date: {{ $invoice->date}}  {{ $invoice->time}} </small>
             
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From :
          <address>
            <strong>{{ $clinic->name }}</strong><br>
            {{ $clinic->address }}<br>
            Phone: {{ $clinic->telephone }}<br>
            Email: {{ $clinic->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To :
          <address>
            <strong>{{ $patient->name }}</strong><br>
            Phone: {{ $patient->mobile }}<br>
            Email: {{ $patient->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice # {{ $invoice->id }}</b><br>
          <b>Payment Due: </b> {{ $invoice->date}}<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

       <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Doctor :
          <address>
            <strong>{{ $admin->name }}</strong><br>
            Phone: {{ $admin->telephone }}<br>
            Email: {{ $admin->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Nurse :
          <address>
            <strong>{{ $nurse->name }}</strong><br>
            Phone: {{ $nurse->mobile }}<br>
            Email: {{ $nurse->email }}
          </address>
        </div>
        
      </div>
      <!-- /.row -->

      
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-6">
          

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{$invoice->total_price}}</td>
              </tr>
              <tr>
                <th>Tax ({{$invoice->tax}}%)</th>
                <td>${{$invoice->total_price * $invoice->tax}}</td>
              </tr>
              <tr>
                <th>Discount: ({{$invoice->discount}}%)</th>
                <td>${{$invoice->total_price * $invoice->discount}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>${{$invoice->total_price + $invoice->total_price * $invoice->tax - $invoice->total_price * $invoice->discount}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a onclick="window.print();" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')
  {{-- here goes js files --}}
  
@endsection