@extends('admin.layouts.app')

@section('title', 'Listagem dos Orçamentos')

@section('content')
<div id="app"></div>

<div class="max-w-5xl mx-auto px-4 py-10">

  {{-- Botão de criação --}}
  <div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-extrabold text-gray-800">📋 Orçamentos</h1>
    <a href="{{ route('budgets.create') }}"
       class="bg-blue-600 text-white font-semibold rounded-md px-5 py-2.5 hover:bg-blue-700 transition duration-150">
      + Novo Orçamento
    </a>
  </div>

  {{-- Mensagens --}}
  @if(session('message'))
    <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">
      {{ session('message') }}
    </div>
  @endif

  @if(session('error'))
    <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
      {{ session('error') }}
    </div>
  @endif

  {{-- Filtro de busca --}}
  <div class="bg-white p-6 rounded-lg shadow mb-10">
    <form action="{{ route('budgets.search') }}" method="GET" class="flex flex-wrap md:flex-nowrap gap-4 items-center justify-center">
      <input
        type="date"
        name="start_date"
        value="{{ request('start_date') }}"
        class="w-full md:w-[180px] border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
      <input
        type="date"
        name="end_date"
        value="{{ request('end_date') }}"
        class="w-full md:w-[180px] border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
      <input
        type="text"
        name="client"
        placeholder="Cliente"
        value="{{ request('client') }}"
        class="w-full md:w-[180px] border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
      <input
        type="text"
        name="seller"
        placeholder="Vendedor(a)"
        value="{{ request('seller') }}"
        class="w-full md:w-[180px] border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring focus:ring-blue-200"
      >
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-md shadow">
        Filtrar
      </button>
    </form>
  </div>

  {{-- Lista de orçamentos --}}
  <div class="space-y-4">
    @forelse ($budgets as $budget)
      <div class="flex items-center justify-between bg-white border border-gray-200 shadow-sm rounded-lg px-6 py-4 hover:shadow-md transition">
        <div>
          <p class="text-lg font-semibold text-gray-900">{{ $budget->client }}</p>
          <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($budget->budget_datetime)->format('d/m/Y H:i') }}</p>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('budgets.show', $budget->id) }}"
             class="text-blue-600 hover:underline font-medium text-sm">Ver</a>
          <a href="{{ route('budgets.edit', $budget->id) }}"
             class="text-blue-600 hover:underline font-medium text-sm">Editar</a>
        </div>
      </div>
    @empty
      <div class="text-center text-gray-500 py-6">Nenhum orçamento encontrado.</div>
    @endforelse
  </div>

  {{-- Paginação --}}
  <div class="mt-10 flex justify-center">
    @if (isset($filters))
      {{ $budgets->appends($filters)->links() }}
    @else
      {{ $budgets->links() }}
    @endif
  </div>

</div>
@endsection
