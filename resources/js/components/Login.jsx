import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function Login() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);
    const [showPassword, setShowPassword] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError('');

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email, password }),
            });

            const data = await response.json();

            if (response.ok) {
                window.location.href = '/vehicules';
            } else {
                setError(data.message || 'Identifiants incorrects.');
            }
        } catch (err) {
            setError('Erreur de connexion. Veuillez réessayer.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-vh-100 d-flex flex-column" style={{ backgroundColor: 'wh' }}>

            {/* Header */}
            <div className="text-white text-center py-3" style={{ backgroundColor: '#e8a020' }}>
                <h5 className="mb-0 fw-bold">🔧 Bienvenue sur Garage Manager</h5>
            </div>

            {/* Contenu centré */}
            <div className="flex-grow-1 d-flex align-items-center justify-content-center">
                <div className="bg-white shadow" style={{ width: '100%', maxWidth: '440px', borderRadius: '8px', overflow: 'hidden' }}>

                    {/* Titre carte */}
                    <div className="text-center py-4" style={{ backgroundColor: '#e8a020' }}>
                        <h4 className="text-white fw-bold mb-0">Connexion</h4>
                    </div>

                    {/* Formulaire */}
                    <div className="p-4">

                        {error && (
                            <div className="alert alert-danger text-center py-2">
                                {error}
                            </div>
                        )}

                        <form onSubmit={handleSubmit}>

                            <div className="mb-3">
                                <label className="form-label fw-bold">Adresse email</label>
                                <input
                                    type="email"
                                    className="form-control"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                    placeholder="exemple@email.com"
                                    required
                                />
                            </div>

                            <div className="mb-4">
                                <label className="form-label fw-bold">Mot de passe</label>
                                <div className="input-group">
                                    <input
                                        type={showPassword ? 'text' : 'password'}
                                        className="form-control"
                                        value={password}
                                        onChange={(e) => setPassword(e.target.value)}
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

                            <button
                                type="submit"
                                className="btn w-100 fw-bold text-white"
                                style={{ backgroundColor: '#e8a020' }}
                                disabled={loading}
                            >
                                {loading ? (
                                    <>
                                        <span className="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Connexion...
                                    </>
                                ) : (
                                    'Se connecter'
                                )}
                            </button>

                        </form>

                        <div className="text-center mt-3">
                            <a href="/forgot-password" style={{ color: '#e8a020', fontSize: '14px' }}>
                                Mot de passe oublié ?
                            </a>
                        </div>

                        <hr />

                        <div className="text-center">
                            <p className="mb-2" style={{ fontSize: '14px' }}>Pas encore de compte ?</p>
                            <a href="/register" className="btn w-100 fw-bold text-white"
                               style={{ backgroundColor: '#e8a020' }}>
                                Créer un compte
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login;