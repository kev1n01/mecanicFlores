<div>
    <h2>Welcome {{ Auth()->user()->roles()->first()->name ?? '' }}, to home</h2>
</div>
