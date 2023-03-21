<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            Proveedora
            <select name="proveedora_id" id="insumo_id" class="form-select">
                @foreach ($proveedoras as $proveedora)
                    <option value="{{$proveedora['id']}}" @if($proveedora['id']==$compra['proveedora_id']) selected @endif>{{$proveedora['razon_social']}}</option>
                @endforeach
            </select>
            {!! $errors->first('proveedora_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            Insumo a Comprar
            <select name="insumo_id" id="insumo_id" class="form-select">
                @foreach ($insumos as $insumo)
                    <option value="{{$insumo['id']}}" @if($insumo['id']==$compra['insumo_id']) selected @endif>{{$insumo['nombre']}}</option>
                @endforeach
            </select>
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

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
