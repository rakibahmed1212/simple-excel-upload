<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div>
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                <main class="mt-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Branch ID</th>
                                <th>Total Customers</th>
                                <th>Total Male Customers</th>
                                <th>Total Female Customers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($counts as $count)
                                <tr>
                                    <td>{{ $count->branch_id }}</td>
                                    <td>{{ $count->total_customer_count }}</td>
                                    <td>{{ $count->total_male_customer_count }}</td>
                                    <td>{{ $count->total_female_customer_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
