<div class="container">
    <div class="row align-items-start pokemon-box">
        <div class="col">
            <x-trainer.generated />
        </div>
        <div class="col">
            <x-trainer.list :collection="$collection" />
        </div>
    </div>
</div>
