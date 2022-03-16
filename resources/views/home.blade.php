@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <div class="alert alert-success">
                <div class="alert-title">
                    {{ __('Welcome') }} {{ auth()->user()->name ?? null }}
                </div>
                <div class="text-muted">
                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="row">
                {{-- Top user Experience --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">Popular Game</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Game Name</th>
                                        <th>Experience</th>
                                        <th>Coin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_game as $game)
                                        <tr>
                                            <td>{{ ($top_game->currentPage() - 1) * $top_game->count() + $loop->iteration }}
                                            </td>
                                            <td>{{ $game->name }}</td>
                                            <td>{{ number_format($game->experiences_sum_total) }}</td>
                                            <td>{{ number_format($game->coins_sum_total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($user_exp->hasPages())
                            <div class="card-footer pb-0">
                                {{ $user_exp->links() }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Top user Experience --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">Top User Experience</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>User Name</th>
                                        <th>Experience</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_exp as $user)
                                        <tr>
                                            <td>{{ ($user_exp->currentPage() - 1) * $user_exp->count() + $loop->iteration }}
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ number_format($user->experiences_sum_total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($user_exp->hasPages())
                            <div class="card-footer pb-0">
                                {{ $user_exp->links() }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Top user Coins --}}
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">Top User Coins</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>User Name</th>
                                        <th>Coins</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_coin as $user)
                                        <tr>
                                            <td>{{ ($user_coin->currentPage() - 1) * $user_coin->count() + $loop->iteration }}
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ number_format($user->coins_sum_total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($user_coin->hasPages())
                            <div class="card-footer pb-0">
                                {{ $user_coin->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
