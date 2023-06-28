@extends('Layout.temp_emp_template')

@section('Page_contents')

<!-- Content -->



<div class="container-xxl flex-grow-1 container-p-y">
<?php date_default_timezone_set("Asia/Calcutta");?>

    <div class="card">

        <div class="table-responsive  p-2">

            <table class="table text-center" id="temp_emp_notification_table">

                <thead class="table-info text-dark ">

                    <tr>

                        <th scope="col">#</th>

                        <th scope="col">Notification</th>

                        <th scope="col">Details</th>
                        <th scope="col">Date & Time</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $sl_no=1?>

                    @foreach($temp_emp_notification as $notification)

                    <tr>

                        <th scope="col">{{$sl_no}}</th>

                        <td>{{$notification->notification_title}}</td>
                        @if($notification->notification_content=='')
                        <td class="text-danger">No Details</td>
                        @else
                        <td>{{$notification->notification_content}}</td>
                        @endif
                        <td>{{date('d/m/Y H:i A',$notification->created_at)}}</td>
                    </tr>

                    <?php $sl_no++;?>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <!-- / Content -->

    @endsection

    @section('Js_contents')

    <script>
        $(document).ready(function() {

            $('#temp_emp_notification_table').DataTable({

                dom: "ftpi"

            });

        });

    </script>

    {{-- <script src="..\assets\js\pages\temp_emp_document_upload.js"></script> --}}

    @endsection
