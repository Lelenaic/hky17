<p>
    Bonjour {{auth()->user()->name}}, votre voiture est prête et vous attend à la borne :<br>
    <b>{{auth()->user()->lastResa()->borne->address}}</b>
</p>