<style>
    table tr {
        height: 40px;
    }
    table td {
        height: 40px;
    }
</style>
<div style="width: 700px; height: 1000px; border: solid 2px black;">
    <table>
        <td width="250px"><img src="https://crm.appliuk.com/assets/images/logoIcon/logo.png" alt="appliuk_logo"
                style="width: 150px; padding: 16px;"></td>
        <td width="250px" style="padding-top: 40px;"><span
                style="font-weight: bold;font-size: 18px;color: #1b0d58;border: solid 2px red;padding: 3px;">AppliUK
                Admission Form</span></td>
        <td width="200px"><span
                style="border: solid 1px black; float: right; width: 130px; height: 130px; text-align: center; margin-right: 14px;">
                <img src="https://crm.appliuk.com/assets/images/donor/{{ $donor->image }}" width="129px"
                    alt=""></span></td>
    </table>
    <div style="padding-left: 30px">
        <p><u>
                <h3 style="color: #001277">Particulars of student:</h3>
            </u></p>
        <table>
            <tr>
                <td>Firstname</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->firstname) }}</span></td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->lastname) }}</span></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->email) }}</span></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->phone) }}</span></td>
            </tr>
            <tr>
                <td>WhatsApp</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->whatsapp) }}</span></td>
            </tr>
            <tr>
                <td>English Test:</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">
                        @php
                            $engtestview = '';
                            $engtests = json_decode($donor->engtest);

                            foreach ($engtests as $engtest) {
                                $engtestview .= $engtest . ', ';
                            }
                            $engtestview = rtrim($engtestview, ', ');
                            echo $engtestview;
                        @endphp</span></td>
            </tr>
            <tr>
                <td>Overall Score</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->score_overall) }}</span></td>
            </tr>
            <tr>
                <td>Low Score</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->low_score) }}</span></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->country) }}</span></td>
            </tr>
            <tr>
                <td>Qualification</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->qualification) }}</span></td>
            </tr>
            <tr>
                <td>Course</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">{{ __($donor->course) }}</span></td>
            </tr>
            <tr>
                <td>Register By</td>
                <td>:</td>
                <td><span style="font-weight: bold; font-size: 18px">
                        @php
                            $agentname = '';
                            if ($donor->agent_id == '') {
                                $agentname = 'Own';
                            } else {
                                $agentname = $donor->agent->name;
                            }

                        @endphp
                        {{ $agentname }}</span></td>
            </tr>
        </table>
        <br>
    </div>
</div>
