<div class="wbRegister__content">
    <div class="popupLogo">
        <img src="/wp-content/themes/waterbridge/images/logo.svg"/>
    </div>
    <div class="popupStep">
        <p>Krok <span>1 z 2</span></p>
    </div>
    <h3 class="popupTitle popupTitle--hasAfter">Stwórz profil inwestora</h3>
    <p class="popupAfterTitle">Stwórz konto inwestora aby móc uczestniczyć w inwestycjach WaterBridge</p>

    <form method="post" name="registerForm" class="registerForm">
        <input type="text" placeholder="Twoje imię" name="registerName" class="input" required/>
        <input type="text" placeholder="Twoje naziwsko" name="registerSurname" class="input" required/>
        <input type="tel" placeholder="Twój numer telefonu" id="phone" name="registerPhone" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" class="input" required/>
        <input type="text" placeholder="Adres e-mail" id="email" name="registerEmail" class="input" required/>
        <input type="password" placeholder="Stwórz hasło" name="registerPass" class="input" required/>
        <p class="formCheckbox">
            <label>
                <input name="registerAcceptance" type="checkbox" id="registerAcceptance" value="forever" required>
                Wyrażam zgodę na przetwarzanie danych w celach marketingowych.
            </label>
        </p>
        <div class="formSubmit">
            <input type="submit" value="Załóż konto i przejdź do następnego kroku" class="btn"/>
        </div>
    </form>

    <div class="loginInfo">
        <p>Jesteś już inwestorem?</p>
        <p class="loginInfo__btn">Zaloguj się</p>
    </div>
    <div class="secureInfo">
        <p>Dbamy o bezpieczeństwo Twoich danych dzięki certyfikatowi SSL.</p>
    </div>
</div>