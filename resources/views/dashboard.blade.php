<x-dashboard-layout>

    <h1 class="text-3xl font-bold mb-6">Bienvenido, {{ auth()->user()->name }} 👋</h1>

    <!-- CARDS DE ESTADÍSTICAS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="stat bg-base-200 rounded-xl shadow-md">
            <div class="stat-title">Clientes</div>
            <div class="stat-value text-primary">120</div>
            <div class="stat-desc">+8 este mes</div>
        </div>

        <div class="stat bg-base-200 rounded-xl shadow-md">
            <div class="stat-title">Préstamos activos</div>
            <div class="stat-value text-secondary">45</div>
            <div class="stat-desc">+4 esta semana</div>
        </div>

        <div class="stat bg-base-200 rounded-xl shadow-md">
            <div class="stat-title">Ingresos</div>
            <div class="stat-value text-success">$34,200</div>
            <div class="stat-desc">Últimos 30 días</div>
        </div>

    </div>

    <!-- TABLA -->
    <div class="bg-base-200 p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold mb-4">Préstamos recientes</h2>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>Carlos López</td>
                        <td>$5,000</td>
                        <td>2025-01-10</td>
                        <td><span class="badge badge-success">Pagado</span></td>
                    </tr>

                    <tr>
                        <td>Ana Gómez</td>
                        <td>$8,500</td>
                        <td>2025-01-14</td>
                        <td><span class="badge badge-warning">Atrasado</span></td>
                    </tr>

                    <tr>
                        <td>Juan Pérez</td>
                        <td>$12,000</td>
                        <td>2025-01-12</td>
                        <td><span class="badge badge-info">En curso</span></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</x-dashboard-layout>
