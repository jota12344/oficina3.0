@extends('admin.layouts.app')

@section('title', 'Visualizando orçamento')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

  <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">📄 Detalhes do Orçamento</h1>

  {{-- Bloco de detalhes --}}
  <div class="bg-white shadow rounded-lg p-6 space-y-4 text-gray-800">

    <div class="border-b pb-2">
      <span class="block text-sm text-gray-500">Data e Hora</span>
      <span class="text-lg font-medium">
        {{ \Carbon\Carbon::parse($budget->budget_datetime)->format('d/m/Y H:i') }}
      </span>
    </div>

    <div class="border-b pb-2">
      <span class="block text-sm text-gray-500">Cliente</span>
      <span class="text-lg font-medium">{{ $budget->client }}</span>
    </div>

    <div class="border-b pb-2">
      <span class="block text-sm text-gray-500">Vendedor(a)</span>
      <span class="text-lg font-medium">{{ $budget->seller }}</span>
    </div>

    <div class="border-b pb-2">
      <span class="block text-sm text-gray-500">Descrição do Orçamento</span>
      <span class="text-lg font-medium">{{ $budget->description }}</span>
    </div>

    <div>
      <span class="block text-sm text-gray-500">Valor Orçado</span>
      <span class="text-xl font-bold text-green-700">R$ {{ number_format($budget->estimated_value, 2, ',', '.') }}</span>
    </div>

  </div>

  {{-- Botão de deletar --}}
  <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" class="mt-8 text-right">
    @csrf
    @method('DELETE')
    <button
      type="submit"
      class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow transition"
      onclick="return confirm('Tem certeza que deseja excluir este orçamento?')"
    >
      🗑️ Deletar Orçamento
    </button>
  </form>

</div>
@endsection
