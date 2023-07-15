
<h2>Hello {{$email_data['name']}}</h2>

<h3>Welcome to Nearblood.com</h3>
<br/>
<br/>
Please click the link below to verify your email and active your account.
<br/>
<br/>

<a href="https://nearblood.com/donor/verify?code={{$email_data['verification_code']}}"><button style="color: white; background-color: #4CAF50; border-radius: 5px; vertical-align: middle; border: none; height: 30px; width: 104px; font-weight: bold; cursor: pointer;" type="button">Click to Verify</button></a>
<br/>
<br/>
Thanks
<br/>
nearblood.com
