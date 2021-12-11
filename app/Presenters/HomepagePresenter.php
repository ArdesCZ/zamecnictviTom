<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

use App\Model\DatabazeManager; // použití modelu DatabazeManager
use Nette\Application\UI\Form; // použití nette formulářů

final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    /**
     * metoda, která vytvoří formulář pro přihlášení do adminSekce webu
     */
    protected function createComponentSignInForm(): Form
    {
        $form = new Form;
        $form->addText('uzivatelskeJmeno', 'Uživatelské jméno:')
            ->setRequired(); // vytvoření prvku text pro zadání uživatelského jména, které je nutné zadat

        $form->addPassword('heslo', 'Heslo:') // vyrvoření prvku pro zadání hesla, které je nutné zadat
        ->setRequired();

        $form->addSubmit('odeslat', 'Přihlásit'); // vytvoření prvku pro tlačítko odeslat

        $form->onSuccess[] = [$this, 'signInFormSucceeded']; // po stisknutí na tlačítko odeslat přejdi na metodu signInFormSucceeded
        return $form;
    }

    /**
     * metoda která nastaví výchozí layout na AdminSekce/@layout.latte z důvodu,
     * že admin má přístup k jiným stránkám a menu tudíž musí mít zvláštní layout
     */
    public function formatLayoutTemplateFiles(): array
    {
        $layouts = parent::formatLayoutTemplateFiles();
        $layouts[] = __DIR__ . "/templates/AdminSekce/@layout.latte"; // natvrdo nastavení výchozího layoutu na AdminSekce/@layout.latte
        return $layouts;
    }

    /**
     * metoda, která zpracuje formulář,
     * ověří zadané údaje, jelikož aplikace má jen jednoho uživatele je načtení údajů pro porovnání ze souboru config/common.neon sekce security
     * pokud jsou údaje správné, přesměruje na AdminSekce:default (home stránka admina)
     */
    public function signInFormSucceeded(Form $form, \stdClass $values): void
    {
        try {
            $this->getUser()->login($values->uzivatelskeJmeno, sha1($values->heslo)); // vložení hesla z formuláře a převod na sha1 hash
            $this->redirect('AdminSekce:default'); // přesměrovat na AdminSekce:default

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Nesprávné přihlašovací jméno nebo heslo.');
            $this->flashMessage('Nesprávné přihlašovací jméno nebo heslo.');
        }
    }

    private $databazeManager;

    /**
     * použití Modelu DatabazeManager.php pro připojení k databázi
    */
    public function __construct(DatabazeManager $databazeManager)
    {
        $this->databazeManager = $databazeManager;
    }

    /**
    * výpis z tabulky za pomocí modelu
     * do šablony foto.latte do proměnné fotky vloží výpis tabulky portfolio
     * výpis je dán pomocí Modelu DatabazeManager.php a jeho metody vypisZTabulky s parametrem nazev databazové tabulky
     */
    public function renderFoto(): void
    {
        $this->template->fotky = $this->databazeManager->vypisZTabulky('portfolio')
            ->order('idPortfolia DESC');
    }

}
