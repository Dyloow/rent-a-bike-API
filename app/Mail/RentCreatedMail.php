<?php

namespace App\Mail;

use App\Models\Rent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use SupplementBacon\LaravelAPIToolkit\Mail\SBMail;

class RentCreatedMail extends Notification
{
    use Queueable;

    public Rent $rent;

    public function __construct(Rent $rent)
    {
        $this->rent = $rent;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $bodyContent = "Bonjour {$this->rent->user->name},<br><br>".
            'Votre location a été confirmée avec les détails suivants :<br><br>'.
            "<strong>Vélo :</strong> {$this->rent->bike->brand} {$this->rent->bike->model}<br>".
            "<strong>Année :</strong> {$this->rent->bike->year}<br>".
            "<strong>Date de début :</strong> {$this->rent->rent_start}<br>".
            "<strong>Date de fin :</strong> {$this->rent->rent_end}<br>".
            "<strong>Prix total :</strong> {$this->rent->total_price} €<br><br>".
            'Merci de votre confiance !';

        return new SBMail(
            bodyBackground: '#ffffff',
            emailBackground: '#F8F8F2',
            headlineText: 'Confirmation de location',
            headlineTextColor: '#ffffff',
            headlineBackground: '#2563eb',
            image: null,
            bodyContent: $bodyContent,
            bodyTextColor: '#666666',
            buttonText: 'Voir mes locations',
            buttonTextColor: '#ffffff',
            buttonBackground: '#2563eb',
            url: url('/rents'),
            bottomNote: 'Si vous n\'avez pas effectué cette réservation, veuillez nous contacter.',
            footerText: 'Location de vélos',
            footerUrl: url('/'),
            mailSubject: 'Confirmation de location',
            centerText: true,
        );
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'rent_id' => $this->rent->id,
            'bike_id' => $this->rent->bike_id,
            'user_id' => $this->rent->user_id,
            'total_price' => $this->rent->total_price,
        ];
    }
}
