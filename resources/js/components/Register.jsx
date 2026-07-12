import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function Register() {
    const [form, setForm] = useState({ name: '', email: '', password: '', password_confirmation: '' });
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);
    const [showPassword, setShowPassword] = useState(false);
    const [showConfirm, setShowConfirm] = useState(false);

    const handleChange = (e) => {
        setForm({ ...form, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError('');

        if (form.password !== form.password_confirmation) {
            setError('Les mots de passe ne correspondent pas.');
            setLoading(false);
            return;
        }

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(form),
            });

            const data = await response.json();

            if (response.ok) {
                window.location.href = '/vehicules';
            } else {
                setError(data.message || "Erreur lors de l'inscription.");
            }
        } catch (err) {
            setError('Erreur de connexion. Veuillez réessayer.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-vh-100 d-flex flex-column" style={{ backgroundColor: 'white' }}>

            <div className="text-white text-center py-3" style={{ backgroundColor: '#e8a020' }}>
                <h5 className="mb-0 fw-bold">🔧 Bienvenue sur Garage Manager</h5>
            </div>

            <div className="flex-grow-1 d-flex align-items-center justify-content-center">
                <div className="bg-white shadow" style={{ width: '100%', maxWidth: '440px', borderRadius: '8px', overflow: 'hidden' }}>

                    <div className="text-center py-4" style={{ backgroundColor: 'white' }}>
                        <h4 className="text-black fw-bold mb-0">Créer un compte</h4>
                    </div>

                    <div className="p-4">

                        {error && (
                            <div className="alert alert-danger text-center py-2">
                                {error}
                            </div>
                        )}

                        <form onSubmit={handleSubmit}>

                            <div className="mb-3">
                                <label className="form-label fw-bold">Nom complet</label>
                                <input
                                    type="text"
                                    name="name"
                                    className="form-control"
                                    value={form.name}
                                    onChange={handleChange}
                                    placeholder="Votre nom"
                                    required
                                />
                            </div>

                            <div className="mb-3">
                                <label className="form-label fw-bold">Adresse email</label>
                                <input
                                    type="email"
                                    name="email"
                                    className="form-control"
                                    value={form.email}
                                    onChange={handleChange}
                                    placeholder="exemple@email.com"
                                    required
                                />
                            </div>

                            <div className="mb-3">
                                <label className="form-label fw-bold">Mot de passe</label>
                                <div className="input-group">
                                    <input
                                        type={showPassword ? 'text' : 'password'}
                                        name="password"
                                        className="form-control"
                                        value={form.password}
                                        onChange={handleChange}
                                        placeholder="••••••••"
                                        required
                                    />
                                    <button
                                        type="button"
                                        className="btn btn-outline-secondary"
                                        onClick={() => setShowPassword(!showPassword)}
                                    >
                                        {showPassword ? '🙈' : '👁️'}
                                    </button>
                                </div>
                            </div>

                            <div className="mb-4">
                                <label className="form-label fw-bold">Confirmer le mot de passe</label>
                                <div className="input-group">
                                    <input
                                        type={showConfirm ? 'text' : 'password'}
                                        name="password_confirmation"
                                        className="form-control"
                                        value={form.password_confirmation}
                                        onChange={handleChange}
                                        placeholder="••••••••"
                                        required
                                    />
                                    <button
                                        type="button"
                                        className="btn btn-outline-secondary"
                                        onClick={() => setShowConfirm(!showConfirm)}
                                    >
                                        {showConfirm ? '🙈' : '👁️'}
                                    </button>
                                </div>
                            </div>

                            <button
                                type="submit"
                                className="btn w-100 fw-bold text-white"
                                style={{ backgroundColor: '#e8a020' }}
                                disabled={loading}
                            >
                                {loading ? (
                                    <>
                                        <span className="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Inscription...
                                    </>
                                ) : (
                                    "S'inscrire"
                                )}
                            </button>

                        </form>

                        <hr />

                        <div className="text-center">
                            <p className="mb-2" style={{ fontSize: '14px' }}>Déjà un compte ?</p>
                            <a href="/login" className="btn w-100 fw-bold text-white"
                               style={{ backgroundColor: '#e8a020' }}>
                                Se connecter
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
}

export default Register;