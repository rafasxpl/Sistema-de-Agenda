<section class="w-100 d-flex flex-column align-items-center">
    <header class="w-75 my-3 d-flex align-items-center gap-3">
        <span class="fs-2">
            <i class="fa-solid fa-plus"></i>
        </span>
        <h1 class="align-self-center fs-2 my-0 text-white">Adicionar Tarefa</h1>
    </header>
    <form class="w-75 d-flex flex-column align-items-center gap-5" action="">
        <div class="d-flex justify-content-center align-items-center gap-5 w-100">
            <div class="w-50">
                <div>
                    <label for="" class="d-block form-label">Título</label>
                    <input class="form-control" type="text" name="tituloTarefa" id="tituloTarefa" placelholder="Seu título">
                </div>
                <div>
                    <label for="descricaoTarefa" class="d-block form-label mt-2">Descrição</label>
                    <textarea class="form-control" rows="5" name="descricaoTarefa" id="descricaoTarefa"></textarea>
                </div>
            </div>
            <div class="w-50">
                <div>
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataConclusao" class="d-block form-label mt-2" for="">Data de Conclusão</label>
                            <input class="form-control" type="date" name="dataConclusaoTarefa" id="dataConclusao">
                        </div>
                        <div class="w-50">
                            <label for="horaConclusaoTarefa" class="d-block form-label mt-2" for="">Hora de Conclusão</label>
                            <input class="form-control" type="time" name="horaConclusaoTarefa" id="horaConclusaoTarefa">
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="w-50">
                            <label for="dataConclusao" class="d-block form-label mt-2" for="">Data de Lembrete</label>
                            <input class="form-control" type="date" name="dataLembreteTarefa" id="dataConclusao">
                        </div>
                        <div class="w-50">
                            <label for="horaConclusaoTarefa" class="d-block form-label mt-2" for="">Hora do Lembrete</label>
                            <input class="form-control" type="time" name="horaLembreteTarefa" id="horaConclusaoTarefa">
                        </div>
                    </div>
                </div>
                <div>
                    <label for="recorrenciaTarefa" class="d-block form-label mt-2" for="">Recorrência</label>
                    <select class="form-select" name="recorrenciaTarefa" id="recorrenciaTarefa">
                        <option value="Recorrente">Recorrente</option>
                        <option value="Não recorrene">Não recorrente</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="w-100 mx-auto d-flex justify-content-center">
            <button class="btn btn-success w-100">Adicionar</button>
        </div>
    </form>
</section>