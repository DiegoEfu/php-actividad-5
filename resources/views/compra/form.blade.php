<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            Proveedora
            {{ Form::select('proveedora_id', $proveedoras, ['class' => 'form-control' . ($errors->has('proveedora_id') ? ' is-invalid' : ''), 'placeholder' => 'Proveedora']) }}
            {!! $errors->first('proveedora_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            Insumo a Comprar
            {{ Form::select('insumo_id', $insumos, ['class' => 'form-control' . ($errors->has('insumo_id') ? ' is-invalid' : ''), 'placeholder' => 'Insumo']) }}
            {!! $errors->first('insumo_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $compra->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('referencia') }}
            {{ Form::text('referencia', $compra->referencia, ['class' => 'form-control' . ($errors->has('referencia') ? ' is-invalid' : ''), 'placeholder' => 'Referencia']) }}
            {!! $errors->first('referencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado') }}
            {{ Form::text('estado', $compra->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
