@extends('admin.layouts.app')

@section('title', 'Criar novo orçamento')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">

  <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">📝 Novo Orçamento</h1>

  {{-- Mensagens de erro --}}
  @if ($errors->any())
    <div class="mb-6 bg-red-100 text-red-800 px-5 py-4 rounded-lg">
      <ul class="list-disc list-inside text-sm space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Formulário --}}
  <form action="{{ route('budgets.store') }}" method="POST" class="bg-white shadow rounded-lg p-6 space-y-6">
    @csrf

    {{-- Data e hora --}}
    <div>
      <label for="budget_datetime" class="block font-medium text-gray-700 mb-1">Data e Hora</label>
      <input
        type="datetime-local"
        name="budget_datetime"
        id="budget_datetime"
        value="{{ old('budget_datetime') }}"
        class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
    </div>

    {{-- Cliente --}}
    <div>
      <label for="client" class="block font-medium text-gray-700 mb-1">Cliente</label>
      <input
        type="text"
        name="client"
        id="client"
        placeholder="Nome do cliente"
        value="{{ old('client') }}"
        class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
    </div>

    {{-- Vendedor --}}
    <div>
      <label for="seller" class="block font-medium text-gray-700 mb-1">Vendedor(a)</label>
      <input
        type="text"
        name="seller"
        id="seller"
        placeholder="Nome do vendedor"
        value="{{ old('seller') }}"
        class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
    </div>

    {{-- Descrição --}}
    <div>
      <label for="description" class="block font-medium text-gray-700 mb-1">Descrição</label>
      <textarea
        name="description"
        id="description"
        rows="5"
        placeholder="Descreva o orçamento..."
        class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >{{ old('description') }}</textarea>
    </div>

    {{-- Valor Orçado --}}
    <div>
      <label for="estimated_value" class="block font-medium text-gray-700 mb-1">Valor Orçado (R$)</label>
      <input
        type="number"
        name="estimated_value"
        id="estimated_value"
        step="0.01"
        placeholder="0,00"
        value="{{ old('estimated_value') }}"
        class="w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
    </div>

    {{-- Botão --}}
    <div class="text-right">
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition"
      >
        Salvar Orçamento
      </button>
    </div>
  </form>
</div>
@endsection
