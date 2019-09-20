<div class="panel panel-default">
    <div class="panel-heading">Detalhes da avaliação</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Título</label>
                    <input type="text" class="form-control" id="title"
                           name="title" placeholder="Título da avaliação" value="{{ $edit ? $review->title : old('title') }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="body">Avaliação</label>
                    <textarea name="body" id="body" class="form-control" cols="30" rows="10">{{ $edit ? $review->body : old('body') }}</textarea>
                </div>
            </div>
            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        Atualizar avaliação
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>
