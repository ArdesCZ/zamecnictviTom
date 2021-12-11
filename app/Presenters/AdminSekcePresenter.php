<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

use App\Model\DatabazeManager; // použití modelu DatabazeManager
use Nette\Application\UI\Form;
use Nette\Database\Context; // použití nette formulářů

final class AdminSekcePresenter extends Nette\Application\UI\Presenter
{
    // Ověření začátek
    /**
     * ověřovací metody, zda uživatel má právo na přístup k stránkám admin sekce
     */
    public function actionAdminHome(): void
    {
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Prihlaseni:prihlaseni');
        }
    }


    public function actionOut(): void
    {
        $this->getUser()->logout();
        $this->redirect('Homepage:prihlasit');

    }

    // Ověření konec

    private $databazeManager;

    /**
     * použití Modelu DatabazeManager.php pro připojení k databázi
     */
    public function __construct(DatabazeManager $databazeManager)
    {
        $this->databazeManager = $databazeManager;
    }



    // Správa portfolia začátek

    /**
     * výpis z tabulky za pomocí modelu
     * do šablony foto.latte do proměnné fotky vloží výpis tabulky portfolio
     * výpis je dán pomocí Modelu DatabazeManager.php a jeho metody vypisZTabulky s parametrem nazev databazové tabulky
     */
    // název presenteru musí odpovídat složce, kde je uložena šablona
    // za render musí být název latte šablony s velkým počátečným písmenem
    public function renderDefault(): void
    {

        $this->template->adminSekce = $this->databazeManager->vypisZTabulky('portfolio')
            ->order('idPortfolia DESC');
    }

    /**
     * metoda, která vytvoří formulář pro vložení nového portfolia
     */
    protected function createComponentFormVlozPortfolio(): Form
    {
        $form = new Form;

        $form->addUpload('file')
            ->addRule(Form::IMAGE, 'Fotografie musí být JPEG, PNG nebo GIF.')
            ->setRequired();


        $form->addSubmit('odeslat');
        // po stisknutí na tlačítko odeslat dojde k volání metody formVlozVystoupeniSucceeded
        $form->onSuccess[] = [$this, 'formVlozPortfolioSucceeded'];

        return $form;
    }

    /**
     *metoda, která zpracuje formulář,
     * do databáze se ukládá pouze název souboru
     * samotná fotka se vkládá do složky ../www/obrazky/portfolio
     */
    public function formVlozPortfolioSucceeded(Form $form, \stdClass $values): void
    {
        $pathFile = "../www/obrazky/portfolio/" . $values->file->getName();
        $values->file->move($pathFile); // samotný přesun fotky

        // pro vkládání do databáze se používá metoda z Modelu DatabazeManager
        // parametry jsou název tabulky, sloupec tabulky, a konkrétní hodnota sloupce
        $this->databazeManager->vlozeniDoTabulky('portfolio', 'nazev', $values->file->getName());

        // načtení hlášky že vložení bylo OK, v latte přístup přes {foreach $flashes as $flash}<div class="flash {$flash->type}">{$flash->message}</div>{/foreach}
        $this->flashMessage('Vložení portfolia bylo úspěšné.'); // zobrazení hlášení o vložení portfolia do šablony
        $this->redirect('AdminSekce:default'); // dojde k obnově stránky
    }

    /**
     * metoda, která vytvoří formulář pro smazání zvolené fotografie
     */
    protected function createComponentFormVymazPortfolio(): Form
    {
        $form = new Form;

        $form->addText('idPortfoliaV');
        $form->addSubmit('odeslatV');
        $form->onSuccess[] = [$this, 'formVymazPortfolioSucceeded'];

        return $form;
    }


    /**
     * metoda, která zpracuje formulář,
     * nejdříve dochází k samotné smazání souboru,
     * poté dochází k smazání informací z databáze
     */
    public function formVymazPortfolioSucceeded(Form $form, \stdClass $values): void
    {
        // hledání názvu souboru pomocí metody z modelu, parametry jsou hledaný výraz, název tabulky, sloupec pro where, a konkrétní hodnota
        $hledejNazevSouboru = $this->databazeManager->hledejHodnoty('nazev','portfolio','idPortfolia', $values->idPortfoliaV);
        $row = $hledejNazevSouboru->fetch();
        $nazevSouboruString = $row[0];
        \Nette\Utils\FileSystem::delete("../www/obrazky/portfolio/$nazevSouboruString");

        // výmaz řádku z databáze pomocí metody z modelu, parametry jsou název tabulky, sloupec, hodnota sloupce
        $this->databazeManager->vymazVTabulce('portfolio','idPortfolia', $values->idPortfoliaV);

        $this->flashMessage('Foto bylo smazané.');
        $this->redirect('AdminSekce:default');
    }





}
