@extends('layouts.management')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/management-dashboard.css') }}">

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>College Management Dashboard</h2>
            <p>Manage student data, fees, and academic details.</p>
        </div>

        <!-- Stats Overview Section -->
        <div class="overview-stats">
            <div class="stat-card">
                <h4>Total Students</h4>
                <p>1500</p>
            </div>
            <div class="stat-card">
                <h4>Total Revenue</h4>
                <p>₹5,00,000</p>
            </div>
            <div class="stat-card">
                <h4>Pending Fees</h4>
                <p>₹50,000</p>
            </div>
            <div class="stat-card">
                <h4>Verified Payments</h4>
                <p>₹4,50,000</p>
            </div>
        </div>

        <!-- Recent Transactions Section -->
        <div class="recent-transactions">
            <h3>Recent Transactions</h3>
            <div class="transactions-list">
                <div class="transaction">
                    <div class="transaction-info">
                        <p><strong>₹10,000</strong></p>
                        <p>1st February 2025</p>
                    </div>
                    <div class="transaction-status">
                        <span class="status-pending">Pending</span>
                    </div>
                </div>
                <div class="transaction">
                    <div class="transaction-info">
                        <p><strong>₹5,000</strong></p>
                        <p>28th January 2025</p>
                    </div>
                    <div class="transaction-status">
                        <span class="status-completed">Completed</span>
                    </div>
                </div>
                <div class="transaction">
                    <div class="transaction-info">
                        <p><strong>₹7,500</strong></p>
                        <p>20th January 2025</p>
                    </div>
                    <div class="transaction-status">
                        <span class="status-pending">Pending</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
