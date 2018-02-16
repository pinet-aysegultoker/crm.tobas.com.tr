<?php
    $user = User::find(Auth::id());
    $reminders = CustomerReminder::where('creator_id', $user->id)->get();

        function DateDiffInterval($sDate1, $sDate2, $sUnit='H') {
        //subtract $sDate2-$sDate1 and return the difference in $sUnit (Days,Hours,Minutes,Seconds)
            $nInterval = strtotime($sDate2) - strtotime($sDate1);
            if ($sUnit=='D') { // days
                $nInterval = $nInterval/60/60/24;
            } else if ($sUnit=='H') { // hours
                $nInterval = $nInterval/60/60;
            } else if ($sUnit=='M') { // minutes
                $nInterval = $nInterval/60;
            } else if ($sUnit=='S') { // seconds
            }
            return $nInterval;
        } //DateDiffInterval
        $differances = array();

?>
<div class="panel panel-crm">
    <div class="panel-heading"><h1>Hatırlatıcılar</h1></div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-default">
                <thead>
                <tr>
                    <th>Zaman</th>
                    <th>Müşteri</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reminders as $reminder)
                    @if($reminder->status == 'active')
                    <?php $customer = Customer::find($reminder->customer_id); ?>
                    <tr>
                        <td><a href="#" data-reminder="{{  $reminder->id }}" data-toggle="modal" data-target="#infoModal">{{ Carbon::parse($reminder->time)->formatLocalized('%d/%m/%Y %H:%M:%S') }}</a></td>
                        <td><a href="#" data-reminder="{{  $reminder->id }}" data-toggle="modal" data-target="#infoModal">{{ $customer->first_name }} {{ $customer->last_name }}</a></td>
                        <td><a href="{{route('customer.reminder.passive',$reminder->id)}}" class="btn btn-danger btn-xs">Hatılatıcıyı Kapat</a></td>
                    </tr>
                    <?php $now_time = Carbon::now();

                    $differances[] += DateDiffInterval(Carbon::now(),$reminder->time);
                    if ((DateDiffInterval(Carbon::now(),$reminder->time)) < 24)
                    {
                        $text = $customer->first_name.' '.$customer->last_name.' isimli müşterinizin hatılatıcı zamanı yaklaşmıştır.';
                    ?>
                    <script>
                        $( document ).ready(function() {
                            popup("{{$text}}");
                        });
                    </script>
                    <?php
                    }
                    else if((DateDiffInterval(Carbon::now(),$reminder->time,'D')) < 1.5)
                    {
                          $text = $customer->first_name.' '.$customer->last_name.' isimli müşterinizin hatılatıcı zamanı yaklaşmıştır.';
                    ?>
                    <script>
                        $( document ).ready(function() {
                            popup("{{$text}}");
                        });
                    </script>
                    <?php
                    }

                    ?>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">Hatırlatıcı Detayları</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th scope="row" class="col-md-4">Oluşturma Zamanı</th>
                        <td id="created_at"></td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-md-4">Hatırlatma Zamanı</th>
                        <td id="time"></td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-md-4">Müşteri</th>
                        <td id="customer"></td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-md-4">Açıklama</th>
                        <td id="description"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Geri Dön</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#infoModal').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);
        var modal = $(this);
        var reminder = button.data('reminder');
        modal.find('#created_at').empty();
        modal.find('#time').empty();
        modal.find('#customer').empty();
        modal.find('#description').empty();
        $.ajax({
            type: "POST",
            url: "{{ route('api.get.reminder') }}",
            beforeSend: function() { $('.loading').show(); },
            complete: function() { $('.loading').hide(); },
            data:'reminder='+reminder,
            success: function(data){
                $.each(JSON.parse(data), function(key, value){
                    modal.find('#created_at').html(value["created_at"]);
                    modal.find('#time').html(value["time"]);
                    modal.find('#customer').html(value["customer"]);
                    modal.find('#description').html(value["description"]);
                });
            }
        });
    });

    function popup(text){
            if (!("Notification" in window)) {
                alert("Bu tarayıcı web bilgilendirme özelliğini desteklemiyor.");
            }// Daha önce kullanıcı izin verdi ise
             else if (Notification.permission === "granted") {
                var options = {
                    body: text,
                    sound: 'http://crm.tobas.com.tr/public/alert.mp3'
                }
                var n = new Notification(text,options);
            }// Eğer onay yoksa
            else if (Notification.permission !== 'denied') {
            // Kullanıcıdan onay ise
                Notification.requestPermission(function (permission) {
                    // Kullanıcı onaylamadı ise tekrar soralım
                    if (permission === "granted") {
                        var options = {
                            body: text,
                            sound: 'http://crm.tobas.com.tr/public/alert.mp3'
                        }
                        var n = new Notification(text,options);
                    }
                });
            }
    };
</script>