<template>
    <div class="row">



        <div class="form-group col-xs-12 col-sm-12 col-md-6  col-md-offset-2">
            <label for="type">Tipo de anúncio:</label>
            <select class="form-control" id="type" name="type" v-model="type">
                <option value="">Selecione</option>
                <option value="1">Artista</option>
                <option value="2">Profissional</option>
            </select>
        </div>




        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="title">Título:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="título do anúncio...">
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="description">Descrição:</label>
            <textarea class="form-control" rows="5" id="description" name="description">
            </textarea>
        </div>




        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2" v-show="type==2">
            <label for="categoria">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria">
                <option value="">Selecione</option>
                <option value="">1</option>
            </select>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2" v-show="type==2">
            <label for="subcategoria">Sub categoria:</label>
            <select class="form-control" id="subcategoria" name="subcategoria">
                <option value="">Selecione</option>
                <option value="">1</option>
            </select>
        </div>




        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado">
                <option value="">Selecione</option>
                <option value="">1</option>
            </select>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="cidade">Cidade:</label>
            <select class="form-control" id="cidade" name="cidade">
                <option value="">Selecione</option>
                <option value="">1</option>
            </select>
        </div>




        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="facebook">Facebook:</label>
            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="informe seu facebook">
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="instagram">Instagram:</label>
            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="informe seu instagram">
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="youtube">Youtube:</label>
            <input type="text" class="form-control" id="youtube" name="youtube" placeholder="informe seu canal do yotube">
        </div>




        <label class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">Estilo musical:</label>
        <div class="checkbox col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label><input type="checkbox" value="">Option 1</label>
        </div>
        <div class="checkbox col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label><input type="checkbox" value="">Option 2</label>
        </div>
        <div class="checkbox col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label><input type="checkbox" value="">Option 3</label>
        </div>



        <div class="form-group col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
            <label for="youtube">video do youtube:</label>
            <input type="text" class="form-control" id="youtubevideo" name="youtubevideo" placeholder="informe um link de vídeo do youtube">
        </div>



    </div>
</template>

<script>
    export default {
        data() {
            return {
                type: 0,
            };
        },
        computed:{

        },
        methods: {

        },
    }
</script>

<style scoped>

</style>
