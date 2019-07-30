<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group">
                <label>Plano</label>
                @if($user->hasActiveSubscription())
                    @foreach($plans as $plan)
                        <div class="radio">
                            <label>
                                <input type="radio" name="plan_id" value="{{$plan->id}}" {{$user->hasActivePlan($plan->id)==true? 'checked=checked' : ''}}>
                                {{$plan->name}}
                            </label>
                        </div>
                    @endforeach
                @else
                    @foreach($plans as $plan)
                        <div class="radio">
                            <label>
                                <input type="radio" name="plan_id" value="{{$plan->id}}">
                                {{$plan->name}}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-12">
        @if ($edit)
            <button type="submit" class="btn btn-primary" id="update-login-details-btn">
                <i class="fa fa-refresh"></i>
                Atualizar
            </button>
        @endif
        </div>
    </div>
</div>
