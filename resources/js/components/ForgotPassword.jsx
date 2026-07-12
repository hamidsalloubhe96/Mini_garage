import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function ForgotPassword() {
    const [email, setEmail] = useState('');
    const [success, setSuccess] = useState('');
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError('');
        setSuccess('');

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email }),
            });

            const data = await response.json();

            if (response.ok) {
                setSuccess('Un lien de réinitialisation a été envoyé à votre adresse email.');
            } else {
                setError(data.message || 'Erreur lors de l\'envoi.');
            }
        } catch (err) {
            setError('Erreur de connexion. Veuillez réessayer.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-vh-100 d-flex flex-column" style={{ backgroundColor: 'white'  }}>

            <div className="text-white text-center py-3" style={{ backgroundColor: '#e8a020'  }}>
                <h5 className="mb-0 fw-bold">🔧 Bienvenue sur Garage Manager</h5>
            </div>

            <div className="flex-grow-1 d-flex align-items-center justify-content-center">
                <div className="bg-white shadow" style={{ width: '100%', maxWidth: '440px', borderRadius: '8px', overflow: 'hidden' }}>

                    <div className="text-center py-4" style={{ backgroundColor: '#e8a020'  }}>
                        <h4 className="text-white fw-bold mb-0">Mot de passe oublié</h4>
                    </div>

                    <div className="p-4">

                        <p className="text-muted text-center mb-4" style={{ fontSize: '14px' }}>
                            Entrez votre adresse email. Nous vous enverrons un lien pour réinitialiser votre mot de passe.
                        </p>

                        {error && (
                            <div className="alert alert-danger text-center py-2">{error}</div>
                        )}

                        {success && (
                            <div className="alert alert-success text-center py-2">{success}</div>
                        )}

                        <form onSubmit={handleSubmit}>

                            <div className="mb-4">
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

                            <button
                                type="submit"
                                className="btn w-100 fw-bold text-white"
                                style={{ backgroundColor: '#e8a020' }}
                                disabled={loading}
                            >
                                {loading ? (
                                    <>
                                        <span className="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Envoi...
                                    </>
                                ) : (
                                    'Envoyer le lien'
                                )}
                            </button>

                        </form>

                        <hr />

                        <div className="text-center">
                            <a href="/login" style={{ color: '#e8a020', fontSize: '14px' }}>
                                Retour à la connexion
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
}

export default ForgotPassword;