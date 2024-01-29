@if (!$collection->isEmpty())
    @foreach ($collection as $pokemon)
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ $pokemon->icon_link }}"
                        class="img-fluid rounded-start {{ $pokemon->types()->first()->name }} pokemon-list-image"
                        alt="{{ $pokemon->name }}">
                </div>
                <div class="col-md-8" style="padding-left: 10px">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title text-capitalize">
                                <span data-pokemon-name-{{ $pokemon->id }}>
                                    {{ $pokemon->name }}
                                </span>
                                - #{{ $pokemon->code }}
                            </h5>
                            @foreach ($pokemon->types as $type)
                                <span class="badge {{ $type->name }}">{{ $type->name }}</span>
                            @endforeach
                        </div>
                        <div class="row align-items-start row-status">
                            <div class="card-text col-3 status-pokemon">
                                <small class="text-muted font-weight-bold">HP</small>
                                <span>{{ $pokemon->getStatus()->hp }}</span>
                            </div>
                            <div class="card-text col-3 status-pokemon">
                                <small class="text-muted font-weight-bold">ATTACK</small>
                                <span>{{ $pokemon->getStatus()->attack }}</span>
                            </div>
                            <div class="card-text col-3 status-pokemon">
                                <small class="text-muted font-weight-bold">DEFENSE </small>
                                <span>{{ $pokemon->getStatus()->defense }}</span>
                            </div>
                            <div class="card-text col-3 status-pokemon">
                                <small class="text-muted font-weight-bold">SPEED</small>
                                <span>{{ $pokemon->getStatus()->speed }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary pokemon-edit"
                data-bs-toggle="modal" data-bs-target="#modal-pokemon-{{ $pokemon->id }}">
                <i class="fa-solid fa-pencil"></i>
            </span>
        </div>
        <div class="modal fade" id="modal-pokemon-{{ $pokemon->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mb-6">
                            <label for="name" class="form-label">Apelido</label>
                            <input type="text" data-pokemon-new-name-{{ $pokemon->id }}="" class="form-control"
                                id="name" aria-describedby="emailHelp">
                        </div>
                        <button type="button" data-token="{{ csrf_token() }}" data-update-pokemon-name=""
                            data-pokemon-id="{{ $pokemon->id }}" class="btn btn-primary"
                            data-bs-dismiss="modal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            Parece que você ainda não adicionou nenhum Pokémon em sua pokedex treinador, clique em "Encontrar Pokémon"
            para
            começar sua jornada!
        </div>
    </div>
@endif
