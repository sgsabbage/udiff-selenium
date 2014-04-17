<?php
namespace SGS\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    protected $books = [
        [
            'title' => 'The Lord Of The Rings',
            'author' => 'J. R. R. Tolkien',
            'synopsis' => 'Elves and dwarfs and orcs oh my!'
        ],
        [
            'title' => 'Dune',
            'author' => 'Frank Herbert',
            'synopsis' => 'Some people go into the desert to try out drugs'
        ],
        [
            'title' => 'A Game of Thrones',
            'author' => 'George R. R. Martin',
            'synopsis' => 'See "All My Friends Are Dead"'
        ]
    ];

    public function indexAction() {
        return $this->render('SGSSiteBundle:Main:index.html.twig');
    }

    public function booksAction() {
        return $this->render('SGSSiteBundle:Main:books.html.twig', array('books' => $this->books));
    }

    public function bookReadAction( $id ) {
        return $this->render('SGSSiteBundle:Main:read.html.twig', array('book' => $this->books[$id]));
    }

}