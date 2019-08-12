
<style>
    .thead-armarios{
        background-color: #115e7f!important;
        display: table-header-group;
        vertical-align: middle;
        border-color: inherit;
        color: white;
    }
    .btn-devolver{
        background-color: #115e7f;
        color: white;
    }
    .btn-devolver:hover{
        color: #f5f5f5!important;
    }
    .table td{
        padding-top: 1.2rem!important;
    }
    .table .tdButton{
        padding-top: 0.8rem!important;
    }

</style>


<main class="w-75 float-right d-flex justify-content-center">
    <div class="bg-white w-100 m-4 p-4">

        <div class="ml-auto" style="height: 40px;">
            <h2 class="text-left text-dark float-left">Armários</h2>

            <div class="float-right">
                <td ><h4 class="input-icon input-icon-left float-left mt-1 mr-2">Filtrar</h4></td>
                <td>
                    <select class="form-control-lg" id="select_armario" style="height: 40px; padding: 0rem 1rem;">
                        <option value="todos">Todos</option>
                        <option value="locados">Locados</option>
                        <option value="disponiveis">Disponíveis</option>
                        <option value="vencidos">Vencidos</option>
                    </select>
                </td>
            </div>
        </div>

        <table class="table mt-4">
            <thead class="thead-armarios">
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-weight-bold">1</th>
                    <td>Mark</td>
                    <td>alugado</td>
                    <td class="tdButton">
                        <button type="button" class="btn btn-devolver">Devolver</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold">2</th>
                    <td>Jacob</td>
                    <td>alugado</td>
                    <td class="tdButton">
                        <button type="button" class="btn btn-devolver">Devolver</button>
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold">3</th>
                    <td>Larry</td>
                    <td>vencido</td>
                    <td class="tdButton">
                        <button type="button" class="btn btn-devolver">Devolver</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</main>