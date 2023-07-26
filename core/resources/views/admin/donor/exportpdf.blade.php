
<table>
    <thead>

        <tr>
            {{-- <th style="background-color:blue; color: white; font-weight: bold; width: 40px;">Serial</th> --}}
            <th style="background-color:blue; color: white; font-weight: bold; width: 120px;">First Name</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 100px;">Last Name</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 190px;">Email</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 110px;">Phone</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 110px;">WhatsApp</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 180px;">English Test</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 110px;">Score Overall</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 95px;">Low Score</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 90px;">Country</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 325px;">Highest Qualification</th>
            <th style="background-color:blue; color: white; font-weight: bold; width: 200px;">Course Name</th>
            {{-- <th style="background-color:blue; color: white; font-weight: bold; width: 180px;">Agent Name</th> --}}
            <th style="background-color:blue; color: white; font-weight: bold; width: 80px;">Documents</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                {{-- <td style="text-align: center">{{ $index+1 }}</td> --}}
                <td>{{ __($donor->lastname) }}</td>
                <td>{{ __($donor->lastname) }}</td>
                <td>{{ __($donor->email) }}</td>
                <td>{{ __($donor->phone) }}</td>
                <td>{{ __($donor->whatsapp) }}</td>
                <td>
                    @php
                    $engtestview = '';
                    $engtests = json_decode($donor->engtest);

                    foreach ($engtests as $engtest) {
                        $engtestview .= $engtest . ', ';
                    }
                    $engtestview = rtrim($engtestview, ', ');
                    echo $engtestview;
                @endphp
                </td>
                <td>{{ __($donor->score_overall) }}</td>
                <td>{{ __($donor->low_score) }}</td>
                <td>{{ __($donor->country) }}</td>
                <td>{{ __($donor->qualification) }}</td>
                <td>{{ __($donor->course) }}</td>
                {{-- <td>{{ $donor->agent->name ?? '' }}</td> --}}
            </tr>
    </tbody>
</table>
