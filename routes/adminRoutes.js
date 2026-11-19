const express = require('express');
const router = express.Router();
const Page = require('../models/Page'); // আপনার ডেটাবেজ মডেল

// অ্যাডমিন অথেন্টিকেশন মিডলওয়্যার ইম্পোর্ট
const isAdmin = require('../middleware/auth'); //[cite: 10]

// স্যানিটাইজেশনের জন্য প্রয়োজনীয় লাইব্রেরি ইমপোর্ট
const createDOMPurify = require('dompurify');
const { JSDOM } = require('jsdom');
const window = new JSDOM('').window;
const DOMPurify = createDOMPurify(window);

// ১. GET: এডিট পেজ দেখানোর রাউট (মিডলওয়্যারযুক্ত)
// অ্যাক্সেস হবে: /admin/edit-legal/:slug
router.get('/edit-legal/:slug', isAdmin, async (req, res) => { //[cite: 10]
    const pageSlug = req.params.slug;
    try {
        const page = await Page.findOne({ slug: pageSlug });
        
        // ভিউ ফাইল রেন্ডার করা
        res.render('admin/edit-legal', { 
            page: page || { slug: pageSlug, content: '' } 
        });
    } catch (err) {
        console.error(err);
        res.status(500).send("Error loading the editor form");
    }
});

// ২. POST: আপডেট হ্যান্ডলার রাউট (মিডলওয়্যার ও স্যানিটাইজেশনসহ)
// অ্যাক্সেস হবে: /admin/update-legal
router.post('/update-legal', isAdmin, async (req, res) => { //[cite: 10]
    const { slug, content } = req.body;
    
    // স্যানিটাইজ করা (ক্ষতিকর স্ক্রিপ্ট ফিল্টার করা)
    const cleanContent = DOMPurify.sanitize(content);

    try {
        await Page.findOneAndUpdate(
            { slug: slug }, 
            { content: cleanContent, updated_at: Date.now() }, 
            { upsert: true, new: true }
        );
        // সফলভাবে আপডেট হওয়ার পর রিডাইরেক্ট
        res.redirect('/admin/legal-pages?success=true');
    } catch (err) {
        console.error(err);
        res.status(500).send("Update Failed");
    }
});

module.exports = router;