<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Для хеширования пароля
use Illuminate\Support\Facades\Storage; // Добавлено для работы с хранилищем файлов

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'description' => 'nullable|string',
            'is_admin' => 'boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Валидация аватара
        ]);

        $validated['is_admin'] = $request->has('is_admin');
        $validated['password'] = Hash::make($validated['password']);

        // Обработка загрузки аватара
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::with('comments')->findOrFail($id);
        $concerts = \App\Models\Concert::where('user_id', $user->id)->orderByDesc('start_at')->get();
        return view('users.show', compact('user', 'concerts'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'description' => 'nullable|string',
            'is_admin' => 'boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Валидация аватара
        ]);

        $validated['is_admin'] = $request->has('is_admin');

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $validated['password'] = Hash::make($request->input('password'));
        } else {
            unset($validated['password']);
        }

        // Обработка загрузки или удаления аватара
        if ($request->hasFile('avatar')) {
            // Удаляем старый аватар, если он существует
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        } elseif ($request->input('remove_avatar')) { // Если установлен флаг удаления аватара
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = null;
        } else {
            // Если файл не загружен и не установлен флаг удаления, сохраняем текущий аватар
            unset($validated['avatar']);
        }

        $user->update($validated);
        return redirect()->route('users.show', $user->id)->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Удаляем аватар, если он существует, перед удалением пользователя
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
