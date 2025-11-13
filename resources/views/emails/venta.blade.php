<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Venta {{ $venta->codigo }}</title>
</head>
<body style="font-family:Arial,Helvetica,sans-serif; color:#111; ">
  <h2>Gracias por su compra</h2>
  <p><strong>Código:</strong> {{ $venta->codigo }}</p>
  <p><strong>Fecha:</strong> {{ optional($venta->fecha_hora)->format('d/m/Y H:i') }}</p>

  <h3>Cliente</h3>
  <p>
    {{ $venta->nombre }} {{ $venta->apellido }}<br>
    {{ $venta->email }}<br>
    {{ $venta->domicilio }}<br>
    {{ $venta->distrito }}, {{ $venta->provincia }}, {{ $venta->departamento }}<br>
    DNI: {{ $venta->dni }}
  </p>

  <h3>Detalle</h3>
  <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse:collapse;">
    <thead>
      <tr>
        <th align="left">#</th>
        <th align="left">Producto</th>
        <th align="right">Cant.</th>
        <th align="right">Precio</th>
        <th align="right">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($venta->detalle as $d)
      <tr>
        <td>{{ $d->idsub }}</td>
        <td>{{ optional($d->articulo)->name ?? ('ID '.$d->idarticulo) }}</td>
        <td align="right">{{ $d->qty }}</td>
        <td align="right">{{ number_format($d->precio, 2) }}</td>
        <td align="right">{{ number_format($d->subtotal, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" align="right"><strong>Subtotal</strong></td>
        <td align="right">{{ number_format($venta->subtotal, 2) }}</td>
      </tr>
      <tr>
        <td colspan="4" align="right"><strong>Cargo envío</strong></td>
        <td align="right">{{ number_format($venta->cargo_envio, 2) }}</td>
      </tr>
      <tr>
        <td colspan="4" align="right"><strong>Total</strong></td>
        <td align="right">{{ number_format($venta->total_venta, 2) }}</td>
      </tr>
    </tfoot>
  </table>

  <p style="margin-top:24px">Cualquier duda, responda este correo.</p>
</body>
</html>
